<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[100%] md:w-[100%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                $request = request();
            @endphp
            <p class="col-span-12"><strong><?=$lang[1]?>:</strong></p>
            <div class="col-span-2">
                <select name="row" class="input" id="row" aria-label="select">
                    <?php
                    function optnsList($arr1,$arr2,$frst,$method){
                        foreach($arr1 as $index => $name){
                    ?>
                    <option value="<?php echo $name ?>" <?php if(isset($method)){ echo $name === $method ? " selected" : ""; }else{ echo $name === $frst ? " selected" : ""; } ?>><?php echo $arr2[$index] ?></option>
                    <?php
                        }
                        }
                    $name = ["1","2","3","4","5","6","7","8","9","10"];
                    $val = ["1","2","3","4","5","6","7","8","9","10"];
                    optnsList($val,$name,"3",$request->row);
                    ?>
                </select>
            </div>
            <p class="col-span-1 flex items-center"><strong>X</strong></p>
            <div class="col-span-2">
                <select name="colum" class="input" id="colum" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                    optnsList($val,$name,"3",$request->colum);
                    ?>
                </select>
            </div>
            <div class="col-span-12">
                <table class="matrix_table w-100">
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
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_2" class="input"  value="<?=isset($request->matrix_0_2)?$request->matrix_0_2:'9'?>" required>
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
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_1" class="input"  value="<?=isset($request->matrix_1_1)?$request->matrix_1_1:'5'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_2" class="input"  value="<?=isset($request->matrix_1_2)?$request->matrix_1_2:'1'?>"  required>
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
                    <tr>
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
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><?=$lang['4']?>:</p>
                            <p class="mt-3">\(<?=$detail['enter']?>\)</p>
                            <p class="mt-3"><?=$lang['5']?>:</p>
                            <p class="mt-3">\(<?=$detail['rref']?>\)</p>
                            <p class="mt-3"><?=$lang['6']?>:</p>
                            <?php 
                                $colum='\left[\begin{matrix}';
                                for ($i=1; $i <= $detail['colum']; $i++) { 
                                if ($i!=$detail['colum']) {
                                    $colum.="x_".$i.'\\\\';
                                }else{
                                    $colum.="x_{".$i.'}';
                                }
                                }
                                $row='\left[\begin{matrix}';
                                for ($i=1; $i <= $detail['row']; $i++) { 
                                if ($i!=$detail['row']) {
                                    $row.="0".'\\\\';
                                }else{
                                    $row.="0";
                                }
                                }
                            ?>
                            <p class="mt-3">\( <?=$detail['rref']?><?=$colum?>\end{matrix}\right] = <?=$row?>\end{matrix}\right]\)</p>
                            <p class="mt-3"><?=$lang['7']?>:</p>
                            <?php if($detail['total']==0){ ?>
                                <?php 
                                $row='\left[\begin{matrix}';
                                for ($i=1; $i <= $detail['row']; $i++) { 
                                    if ($i!=$detail['row']) {
                                    $row.="0".'\\\\';
                                    }else{
                                    $row.="0";
                                    }
                                }
                                ?>
                                <p class="mt-3 font-s-18">\(<?=$row?>\end{matrix}\right]\)</p>
                            <?php }else{ ?>
                                <p class="mt-3 font-s-18">\(<?=$detail['null']?>\)</p>
                            <?php } ?>
                            <p class="mt-3"><?=$lang['8']?>: <?=$detail['total']?></p>
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
