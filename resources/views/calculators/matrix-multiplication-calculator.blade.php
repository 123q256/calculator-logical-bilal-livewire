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
            <p class="col-span-12"><strong><?=$lang['1']." A ".$lang['2']?>:</strong></p>
            <div class="col-span-2">
                <select name="rows1" class="input" id="rows1" aria-label="select">
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
                    optnsList($val,$name,"2",$request->rows1);
                    ?>
                </select>
            </div>
            <p class="col-span-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select name="columns1" class="input" id="columns1" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                        optnsList($val,$name,"2",$request->columns1);
                    ?>
                </select>
            </div>
            <p class="col-span-12"><strong><?=$lang['1']." B ".$lang['2']?></strong></p>
            <div class="col-span-2">
                <select name="matrix2" class="input" id="rows2" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                        optnsList($val,$name,"2",$request->matrix2);
                    ?>
                </select>
            </div>
            <p class="col-span-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select name="matrix22" class="input" id="columns2" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                        optnsList($val,$name,"2",$request->matrix22);
                    ?>
                </select>
            </div>
            <div class="col-span-4 my-auto ps-2">
                <button type="button" name="submit" id="btn2" title="Add More Fields" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang[3]?></button>
            </div>
            <p class="col-span-12"><strong><?=$lang['1']?> A</strong></p>
            <div class="col-span-12">
                <table id="matrix1">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix1_1" class="input" value="<?=isset($request->matrix1_1)?$request->matrix1_1:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix1_2" class="input"  value="<?=isset($request->matrix1_2)?$request->matrix1_2:'2'?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j <= $request->columns1; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix1_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix1_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix2_1" class="input" value="<?=isset($request->matrix2_1)?$request->matrix2_1:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix2_2" class="input"  value="<?=isset($request->matrix2_2)?$request->matrix2_2:'2'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j <= $request->columns1; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix2_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix2_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @isset($request->submit)
                        @for ($i = 3; $i <= $request->rows1; $i++)
                            <tr>
                                @for ($j = 1; $j <= $request->columns1; $j++)
                                    <td>
                                        <div class="px-1 pt-2">
                                            @php $mat = 'matrix'.$i.'_'. $j; @endphp
                                            <input type="number" step="any" name="{{ 'matrix' . $i . '_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    @endisset
                </table>
            </div>
            <p class="col-span-12"><strong><?=$lang['1']?> B</strong></p>
            <div class="col-span-12">
                <table id="matrix2">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix31_1" class="input" value="<?=isset($request->matrix31_1)?$request->matrix31_1:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix31_2" class="input"  value="<?=isset($request->matrix31_2)?$request->matrix31_2:'2'?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j <= $request->matrix22; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix31_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix31_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix32_1" class="input" value="<?=isset($request->matrix32_1)?$request->matrix32_1:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix32_2" class="input"  value="<?=isset($request->matrix32_2)?$request->matrix32_2:'2'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j <= $request->matrix22; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix32_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix32_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @isset($request->submit)
                        @for ($i = 3; $i <= $request->matrix2; $i++)
                            <tr>
                                @for ($j = 1; $j <= $request->matrix22; $j++)
                                    <td>
                                        <div class="px-1 pt-2">
                                            @php $mat = 'matrix3' . $i . '_' . $j; @endphp
                                            <input type="number" step="any" name="{{ 'matrix3' . $i . '_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    @endisset
                </table>
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
        <div class="w-full mt-3 overflow-x-auto">
            @php
                $count_rows = $request->rows1;
                $count_columns = $request->columns1;
                $matrix2 = $request->matrix2;
                $matrix22 = $request->matrix22;
            @endphp
            <div class="w-full">
                <div class="w-full text-[16px]">
                    <p class="mt-2 text-[18px]">\( \begin{bmatrix}<?php
                        for($i=1;$i<=$matrix2;$i++){
                          for($j=1;$j<=$matrix22;$j++){
                          $second_matrix=$request['matrix3' . $i . '_' . $j];
                          $second_matrix;
                        }
                       }
                        $result=array();
                        for($i=1;$i<=$count_rows;$i++){
                          for($j=1;$j<=$matrix22;$j++){
                            $result[$i][$j]=0;
                            for($k=1;$k<=$matrix2;$k++){
                             $result[$i][$j]+=$request['matrix' . $i . '_' . $k]*$request['matrix3' . $k . '_' . $j];
                        }
                      }
                    }
                      for($i=1;$i<=$count_rows;$i++){
                        for($j=1;$j<=$matrix22;$j++){  
                          if($j<=$matrix22-0 && ($j!==1)){
                            ?>
                            &
                            <?php
                          }
                          echo $result[$i][$j];
                      } ?>
                      \\ 
                      <?php
                    }
                                ?>
                                \end{bmatrix} \)
                                </p>
                <p class="mt-2"><strong><?=$lang['5']?>:</strong></p>
                <p class="mt-2">
                <?=$lang['1']?> A
                \(
                    \begin{bmatrix}
                        <?php
                        for ($i=1; $i <=$count_rows;$i++) { 
                            for($j=1;$j<=$count_columns;$j++){
                            if($j<=$count_columns-0 && ($j!==1)){
                                ?>
                                &
                                <?php
                            }
                            $first_matrix=$request['matrix' . $i . '_' . $j];
                            echo $first_matrix ?><?php ; 
                            }
                            ?>
                            \\
                            <?php
                            } 
                        ?>
                        \end{bmatrix} \)
                    </p>
                    <p class="mt-2">
                        <?=$lang['1']?> B
                        \(
                           \begin{bmatrix}
                            <?php
                            for ($i=1; $i <=$matrix2;$i++) { 
                              for ($j=1; $j<=$matrix22;$j++) { 
                                if($j<=$matrix22-0 && ($j!==1)){
                                    ?>
                                    &
                                    <?php
                                  }
                              $second_matrix=$request['matrix3' . $i . '_' . $j];
                              echo $second_matrix;
                              }
                              ?>
                              \\
                              <?php
                            }
                            ?>
                                \end{bmatrix} \)</p>
                    <p class="mt-2"><?=$lang['6']?> 1:</p>
                    <p class="mt-2">
              \( \begin{bmatrix}
                        <?php
              for($i=1;$i<=$count_rows;$i++){
              for($j=1;$j<=$matrix22;$j++){
                $result[$i][$j]=0;
                for($k=1;$k<=$matrix2;$k++){
                  if ($k==1) {
                    echo "( ";
                  }
                  if ($k==$matrix2) {
                    echo $request['matrix' . $i . '_' . $k]."*".$request['matrix3' . $k . '_' . $j]." ) ";
                  }else{
                    echo $request['matrix' . $i . '_' . $k]."*".$request['matrix3' . $k . '_' . $j]."+";
                  }
                 $result[$i][$j]+=$request['matrix' . $i . '_' . $k]*$request['matrix3' . $k . '_' . $j];
                $result[$i][$j];
                }
              }
              ?>
              \\
              <?php
            }
           ?>
          \end{bmatrix} \)</p>
          <p class="mt-2"><?=$lang['6']?> 2:</p>
          <p class="mt-2">\( \begin{bmatrix}
                        <?php
              for($i=1;$i<=$count_rows;$i++){
              for($j=1;$j<=$matrix22;$j++){
                $result[$i][$j]=0;
                for($k=1;$k<=$matrix2;$k++){
                  if($k==1){
                    echo"(";
                  }
                  if ($k==$matrix2) {
                    echo $request['matrix' . $i . '_' . $k]*$request['matrix3' . $k . '_' . $j]." ) ";
                  }else{
                    echo $request['matrix' . $i . '_' . $k]*$request['matrix3' . $k . '_' . $j]."+";
                  }
                }
              }
              ?>
              \\
              <?php
            }
           ?>
                        \end{bmatrix} \)</p>
                <p class="mt-2"><?=$lang['6']?> 3:</p>
                <p class="mt-2">\( <?php
            $result=array();
          for($i=1;$i<=$count_rows;$i++){
            for($j=1;$j<=$matrix22;$j++){
               $result[$i][$j]=0;
              for($k=1;$k<=$matrix2;$k++){
              $result[$i][$j]+=$request['matrix' . $i . '_' . $k]*$request['matrix3' . $k . '_' . $j];
              $result[$i] [$j];
            }
          }
        }
            ?>
                \begin{bmatrix}
                <?php
                for($i=1;$i<=$count_rows;$i++){
                    for($j=1;$j<=$matrix22;$j++){
                      if($j<=$matrix22-0 &&  ($j!==1)){
                        ?>
                        &
                        <?php
                      }
                   $result[$i][$j];
                   echo $result[$i][$j];?>
                   <?php
                    }
                    ?>
                    \\
                    <?php
                  }
                 ?>
  \end{bmatrix} \)</p>
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
            document.getElementById('btn2').addEventListener('click', function() {
                var rows1 = document.getElementById('rows1').value;
                var columns1 = document.getElementById('columns1').value;
                var matrix1 = document.getElementById('matrix1');
                var rowCount = matrix1.getElementsByTagName('tr').length;
                var rows2 = document.getElementById('rows2').value;
                var columns2 = document.getElementById('columns2').value;
                var matrix2 = document.getElementById('matrix2');
                var rowCount2 = matrix2.getElementsByTagName('tr').length;
                // Adjust rows for matrix1
                if (rows1 > rowCount) {
                    for (var i = 1; i <= rows1 - rowCount; i++) {
                        var newRow = document.createElement('tr');
                        matrix1.appendChild(newRow);
                    }
                } else if (rows1 < rowCount) {
                    for (var i = 1; i <= rowCount - rows1; i++) {
                        matrix1.removeChild(matrix1.lastElementChild);
                    }
                }
                // Adjust columns for each row in matrix1
                var row = 0;
                Array.prototype.forEach.call(matrix1.getElementsByTagName('tr'), function(tr) {
                    row++;
                    var colCount = tr.getElementsByTagName('td').length;
                    if (columns1 > colCount) {
                        for (var i = (colCount + 1); i <= columns1; i++) {
                            var newTd = document.createElement('td');
                            newTd.innerHTML = '<div class="px-1 pt-2">' +
                                            '<input type="number" step="any" name="matrix' + row + '_' + i + '" class="input" value="2" required>' +
                                            '</div>';
                            tr.appendChild(newTd);
                        }
                    } else if (colCount > columns1) {
                        for (var i = 1; i <= colCount - columns1; i++) {
                            tr.removeChild(tr.lastElementChild);
                        }
                    }
                });
                // Adjust rows for matrix2
                if (rows2 > rowCount2) {
                    for (var k = 1; k <= rows2 - rowCount2; k++) {
                        var newRow2 = document.createElement('tr');
                        matrix2.appendChild(newRow2);
                    }
                } else if (rows2 < rowCount2) {
                    for (var i = 1; i <= rowCount2 - rows2; i++) {
                        matrix2.removeChild(matrix2.lastElementChild);
                    }
                }
                // Adjust columns for each row in matrix2
                var row2 = 0;
                Array.prototype.forEach.call(matrix2.getElementsByTagName('tr'), function(tr) {
                    row2++;
                    var colCount2 = tr.getElementsByTagName('td').length;
                    if (columns2 > colCount2) {
                        for (var i = (colCount2 + 1); i <= columns2; i++) {
                            var newTd2 = document.createElement('td');
                            newTd2.innerHTML = '<div class="px-1 pt-2">' +
                                            '<input type="number" step="any" name="matrix3' + row2 + '_' + i + '" class="input" value="5" required>' +
                                            '</div>';
                            tr.appendChild(newTd2);
                        }
                    } else if (colCount2 > columns2) {
                        for (var i = 1; i <= colCount2 - columns2; i++) {
                            tr.removeChild(tr.lastElementChild);
                        }
                    }
                });
            });
        </script>
    @endpush
</form>
