<form class="row w-full" action="{{ url()->current() }}/" method="POST">
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
            <div class="col-span-6">
                <label for="row" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <select name="row" class="input" id="row" aria-label="select">
                        <?php
                        function optnsList($arr1,$arr2,$frst,$method){
                            foreach($arr1 as $index => $name){
                        ?>
                        <option value="<?php echo $name ?>" <?php if(isset($method)){ echo $name === $method ? " selected" : ""; }else{ echo $name === $frst ? " selected" : ""; } ?>><?php echo $arr2[$index] ?></option>
                        <?php
                            }
                            }
                        $name = ["2","3","4"];
                        $val = ["2","3","4"];
                        optnsList($val,$name,"3",$request->row);
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="colum" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <select name="colum" class="input" id="colum" aria-label="select">
                        <?php
                        $name = ["1","2","3","4"];
                        $val = ["1","2","3","4"];
                        optnsList($val,$name,"3",$request->colum);
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <table class="matrix_table w-full">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_0" class="input" value="<?=isset($request->matrix_0_0)?$request->matrix_0_0:'1'?>"  required>
                            </div>
                        </td>
                        <td class="{{ isset($request->row) && $request->colum < 2  ? 'd-none' : ''}}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_1" class="input"  value="<?=isset($request->matrix_0_1)?$request->matrix_0_1:'1'?>" required>
                            </div>
                        </td>
                        <td class="{{ isset($request->row) && $request->colum < 3  ? 'd-none' : ''}}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_2" class="input"  value="<?=isset($request->matrix_0_2)?$request->matrix_0_2:'0'?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->colum; $j++)
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
                        <td class="{{ isset($request->row) && $request->colum < 2  ? 'd-none' : ''}}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_1" class="input"  value="<?=isset($request->matrix_1_1)?$request->matrix_1_1:'5'?>"  required>
                            </div>
                        </td>
                        <td class="{{ isset($request->row) && $request->colum < 3  ? 'd-none' : ''}}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_2" class="input"  value="<?=isset($request->matrix_1_2)?$request->matrix_1_2:'-3'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->colum; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix_1_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix_1_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr class="{{ isset($request->row) && $request->row == 2  ? 'd-none' : ''}}">
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_2_0" class="input" value="<?=isset($request->matrix_2_0)?$request->matrix_2_0:'1'?>"  required>
                            </div>
                        </td>
                        <td class="{{ isset($request->row) && $request->colum < 2  ? 'd-none' : ''}}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_2_1" class="input"  value="<?=isset($request->matrix_2_1)?$request->matrix_2_1:'2'?>"  required>
                            </div>
                        </td>
                        <td class="{{ isset($request->row) && $request->colum < 3  ? 'd-none' : ''}}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_2_2" class="input"  value="<?=isset($request->matrix_2_2)?$request->matrix_2_2:'7'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->colum; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix_2_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix_2_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @isset($request->submit)
                        @for ($i = 3; $i < $request->row; $i++)
                            <tr>
                                @for ($j = 0; $j < $request->colum; $j++)
                                    <td>
                                        <div class="px-1 pt-2">
                                            @php $mat = 'matrix_' . $i . '_' . $j; @endphp
                                            <input type="number" step="any" name="{{ 'matrix_' . $i . '_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    @endisset
                </table>
            </div>
            <div class="col-span-12">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['3']?></button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['4']?></button>
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
                <div class="w-full  mt-3">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[18px]"><strong id="ans"></strong></p>
                            <?php 
                            if ($detail['row']==2 && $detail['colum']==2) {
                                $a1=$request->matrix_0_0;
                                $a2=$request->matrix_0_1;
                                $b1=$request->matrix_1_0;
                                $b2=$request->matrix_1_1;
                                $ans=($a1*$b2)-($b1*$a2);
                                ?>
                                <p class="mt-3"><?=$lang['6']?>:</p>
                                <p class="mt-3"><?=$lang['7']?> A, B <?=$lang['8']?>. i.e. |D|=0</p>
                                <p class="mt-3">\(A = (<?=$a1?>,<?=$a2?>), B = (<?=$b1?>,<?=$b2?>)\)</p>
                                <p class="mt-3">\(|D|=\left|\begin{array}{cc}<?=$a1?> & <?=$a2?>\\<?=$b1?> & <?=$b2?>\end{array}\right|\)</p>
                                <p class="mt-3">\(|D|= (<?=$a1?>) \times (<?=$b2?>) - (<?=$b1?>) \times (<?=$a2?>)\)</p>
                                <p class="mt-3">\(|D|= (<?=$a1*$b2?>) - (<?=$b1*$a2?>)\)</p>
                                <p class="mt-3">\(|D|= <?=$ans?>\)</p>
                                <?php if ($ans!=0) { ?>
                                <p class="mt-3">\(|D|= <?=$ans?> ≠ 0\)</p>
                                <p class="mt-3"><?=$lang['9']?> \( |D| ≠ 0,\) <?=$lang['10']?> A, B <?=$lang['11']?>.</p>
                                <?php }else{ ?>
                                <p class="mt-3"><?=$lang['9']?> \( |D| = 0,\) <?=$lang['10']?> A, B <?=$lang['12']?>.</p>
                                <?php } ?>
                            <?php }elseif($detail['row']==3 && $detail['colum']==3){
                                $a1=$request->matrix_0_0;
                                $a2=$request->matrix_0_1;
                                $a3=$request->matrix_0_2;
                                $b1=$request->matrix_1_0;
                                $b2=$request->matrix_1_1;
                                $b3=$request->matrix_1_2;
                                $c1=$request->matrix_2_0;
                                $c2=$request->matrix_2_1;
                                $c3=$request->matrix_2_2;
                                ?>
                                <p class="mt-3"><?=$lang['6']?>:</p>
                                <p class="mt-3"><?=$lang['7']?> A, B, C <?=$lang['8']?>. i.e. |D|=0</p>
                                <p class="mt-3">\(A = (<?=$a1?>,<?=$a2?>,<?=$a3?>), B = (<?=$b1?>,<?=$b2?>,<?=$b3?>), C = (<?=$c1?>,<?=$c2?>,<?=$c3?>)\)</p>
                                <p class="mt-3">\(|D|= \left|\begin{array}{ccc}<?=$a1?> & <?=$a2?> & <?=$a3?>\\<?=$b1?> & <?=$b2?> & <?=$b3?>\\<?=$c1?> & <?=$c2?> & <?=$c3?>\end{array}\right|  \)</p>
                                <p class="mt-3">\(|D|= <?=$a1?> \times \left|\begin{array}{cc}<?=$b2?> & <?=$b3?>\\<?=$c2?> & <?=$c3?>\end{array}\right| - (<?=$a2?>) \times \left|\begin{array}{cc}<?=$b1?> & <?=$b3?>\\<?=$c1?> & <?=$c3?>\end{array}\right| + (<?=$a3?>) \times \left|\begin{array}{cc}<?=$b1?> & <?=$b2?>\\<?=$c1?> & <?=$c2?>\end{array}\right|\)</p>
                                <p class="mt-3">\(|D|= <?=$a1?> \times ((<?=$b2?>) \times (<?=$c3?>) - (<?=$b3?>) \times (<?=$c2?>)) - (<?=$a2?>) \times ((<?=$b1?>) \times (<?=$c3?>) - (<?=$b3?>) \times (<?=$c1?>)) + (<?=$a3?>) \times ((<?=$b1?>) \times (<?=$c2?>) - (<?=$b2?>) \times (<?=$c1?>))\)</p>
                                <p class="mt-3">\(|D|= <?=$a1?> \times ((<?=$b2*$c3?>) - (<?=$b3*$c2?>)) - (<?=$a2?>) \times ((<?=$b1*$c3?>) - (<?=$b3*$c1?>)) + (<?=$a3?>) \times ((<?=$b1*$c2?>) - (<?=$b2*$c1?>))\)</p>
                                <p class="mt-3">\(|D|= <?=$a1?> \times (<?=($b2*$c3)-($b3*$c2)?>) - (<?=$a2?>) \times (<?=($b1*$c3)-($b3*$c1)?>) + (<?=$a3?>) \times (<?=($b1*$c2)-($b2*$c1)?>)\)</p>
                                <p class="mt-3">\(|D|= (<?=($a1)*(($b2*$c3)-($b3*$c2))?>) - (<?=($a2)*(($b1*$c3)-($b3*$c1))?>) + (<?=($a3)*(($b1*$c2)-($b2*$c1))?>)\)</p>
                                <p class="mt-3">\(|D|= <?=$ans=(($a1)*(($b2*$c3)-($b3*$c2)))-(($a2)*(($b1*$c3)-($b3*$c1)))+(($a3)*(($b1*$c2)-($b2*$c1)))?>\)</p>
                                <?php if ($ans!=0) { ?>
                                    <p class="mt-3">\(|D|= <?=$ans?> ≠ 0\)</p>
                                    <p class="mt-3"><?=$lang['9']?> \( |D| ≠ 0,\) <?=$lang['10']?> A, B, C <?=$lang['11']?>.</p>
                                <?php }else{ ?>
                                    <p class="mt-3"><?=$lang['9']?> \( |D| = 0,\) <?=$lang['10']?> A, B, C <?=$lang['12']?>.</p>
                                <?php } ?>
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
        @isset($detail)
            <script>
                function check2nbr0(a,b) { 
                return a*a + b*b === 0;
                }

                function check3nbr0(a,b,c) {
                return a*a + b*b + c*c === 0;
                }

                function check4nbr0(a,b,c,d) {
                return a*a + b*b + c*c + d*d === 0;
                }

                function getVal(a) {
                if (isNaN(a)) {
                    return '';
                } else {
                    return (a).toFixed(4);
                }
                }
                function GetResult(rows,columns, x1,x2,x3,x4, y1,y2,y3,y4, z1,z2,z3,z4, u1,u2,u3,u4) {
                    var input = [[x1,x2,x3,x4],[y1,y2,y3,y4],[z1,z2,z3,z4],[u1,u2,u3,u4]];
                    var matrix = [];
                    var i,j,k;
                    var rank = rows;
                    var safe;
                    var noZero = 0;
                    var disAns = 1;
                
                    for (i = 0; i < rows; i++) {
                        matrix.push([]);
                        for (j = 0; j < columns; j++) {
                        matrix[i].push(getVal(input[i][j]));
                        disAns *= input[i][j];
                        }
                    }
                
                    for (k = 0; k < Math.min(rows,columns); k++) {
                        for (i = k-noZero+1; i < rows; i++) {
                        if (matrix[k-noZero][k] == 0) {
                            safe = matrix[k-noZero];
                            matrix[k-noZero] = matrix[i];
                            matrix[i] = safe;
                        }
                        }
                        if (matrix[k-noZero][k] == 0) {
                        noZero += 1;
                        } else {
                        for (i = columns - 1; i >= 0; i--) {
                            matrix[k-noZero][i] = Math.round(matrix[k-noZero][i] / matrix[k-noZero][k], 5);
                        }
                        for (i = k-noZero+1; i < rows; i++) {
                            for (j = columns - 1; j >= k; j--) {
                            matrix[i][j] = Math.round(matrix[i][j] - matrix[i][k] * matrix[k-noZero][j], 5);
                            }
                        }
                        }
                    }
                
                    for (i = 0; i < rows; i++) {
                        if (columns == 1) {
                        if (matrix[i][0] == 0) {
                            rank -= 1;
                        }
                        } else if (columns == 2) {
                        if (check2nbr0(matrix[i][0], matrix[i][1])) {
                            rank -= 1;
                        }
                        } else if (columns == 3) {
                        if (check3nbr0(matrix[i][0], matrix[i][1], matrix[i][2])) {
                            rank -= 1;
                        }
                        } else if (columns == 4) {
                        if (check4nbr0(matrix[i][0], matrix[i][1], matrix[i][2], matrix[i][3])) {
                            rank -= 1;
                        }
                        }
                    }
                
                    if (!isNaN(disAns)) {
                        if (rank != rows) {
                            document.getElementById('ans').innerText = 'Linearly Dependent.';
                        } else {
                            document.getElementById('ans').innerText = 'Linearly Independent.';
                        }
                    }
                }
                var noOfRows= Number({{$request->row}});
                var noOfColumns = Number({{$request->colum}});
                var showMatrix = Number(0);
                var a1 = Number({{((isset($request->matrix_0_0)?$request->matrix_0_0:0))}});
                var a2 = Number({{((isset($request->matrix_0_1)?$request->matrix_0_1:0))}});
                var a3 = Number({{((isset($request->matrix_0_1)?$request->matrix_0_2:0))}});
                var a4 = Number({{((isset($request->matrix_0_1)?$request->matrix_0_3:0))}});
                var b1 = Number({{((isset($request->matrix_1_0)?$request->matrix_1_0:0))}});
                var b2 = Number({{((isset($request->matrix_1_1)?$request->matrix_1_1:0))}});
                var b3 = Number({{((isset($request->matrix_1_2)?$request->matrix_1_2:0))}});
                var b4 = Number({{((isset($request->matrix_1_3)?$request->matrix_1_3:0))}});
                var c1 = Number({{((isset($request->matrix_2_0)?$request->matrix_2_0:0))}});
                var c2 = Number({{((isset($request->matrix_2_1)?$request->matrix_2_1:0))}});
                var c3 = Number({{((isset($request->matrix_2_2)?$request->matrix_2_2:0))}});
                var c4 = Number({{((isset($request->matrix_2_3)?$request->matrix_2_3:0))}});
                var d1 = Number({{((isset($request->matrix_3_0)?$request->matrix_3_0:0))}});
                var d2 = Number({{((isset($request->matrix_3_1)?$request->matrix_3_1:0))}});
                var d3 = Number({{((isset($request->matrix_3_2)?$request->matrix_3_2:0))}});
                var d4 = Number({{((isset($request->matrix_3_3)?$request->matrix_3_3:0))}});
                GetResult(noOfRows,noOfColumns, a1,a2,a3,a4, b1,b2,b3,b4, c1,c2,c3,c4, d1,d2,d3,d4);
            </script>
        @endisset
        <script>
            function crDetMatrix(mat, row) {
                var matrixOptVal = mat;
                var matrixTable = document.querySelector(".matrix_table > tbody");
                var matrixRowLen = matrixTable.getElementsByTagName("tr").length;

                if (row > matrixRowLen) {
                    for (var i = 0; i < (row - matrixRowLen); i++) {
                    var newRow = document.createElement("tr");
                    matrixTable.appendChild(newRow);
                    }
                } else if (row < matrixRowLen) {
                    for (var i = 0; i < (matrixRowLen - row); i++) {
                    matrixTable.removeChild(matrixTable.lastElementChild);
                    }
                }
                Array.prototype.forEach.call(matrixTable.getElementsByTagName("tr"), function(tr, index) {
                    var matrixTdLen = tr.getElementsByTagName("td").length;
                    var matrixTdLens = matrixTdLen;
                    for (var i = 0; i < (matrixOptVal - matrixTdLen); i++) {
                        var newTd = document.createElement("td");
                        var div = document.createElement("div");
                        div.className = "px-1 pt-2";
                        var input = document.createElement("input");
                        input.type = "number";
                        input.className = "input";
                        input.step = "any";
                        input.name = "matrix_" + index + "_" + matrixTdLens;
                        input.value = "0";
                        input.id = "matrix_" + index + "_" + matrixTdLens;
                        input.required = true;
                        div.appendChild(input);
                        newTd.appendChild(div);
                        tr.appendChild(newTd);

                        matrixTdLens++;
                    }
                });
                Array.prototype.forEach.call(matrixTable.getElementsByTagName("tr"), function(tr) {
                    var matrixTdLen = tr.getElementsByTagName("td").length;
                    for (var i = 0; i < (matrixTdLen - matrixOptVal); i++) {
                    tr.removeChild(tr.lastElementChild);
                    }
                });
            }
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
            document.getElementById("colum").addEventListener("change", function() {
                crDetMatrix(document.getElementById("colum").value, document.getElementById("row").value);
            });
            document.getElementById("row").addEventListener("change", function() {
                crDetMatrix(document.getElementById("colum").value, document.getElementById("row").value);
            });
        </script>
    @endpush
</form>
