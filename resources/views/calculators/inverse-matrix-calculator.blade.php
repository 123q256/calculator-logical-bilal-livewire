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
                <label for="dtrmn_slct_method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select id="dtrmn_slct_method" name="dtrmn_slct_method" class="input dtrmn_mtrx_slct">
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
                          optnsList($val,$name,"3",$request->dtrmn_slct_method);
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <table class="w-100 dtrmn_mtrx_tbl">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_0_0" class="input" value="<?=isset($request->dtrmn_0_0)?$request->dtrmn_0_0:'1'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_0_1" class="input"  value="<?=isset($request->dtrmn_0_1)?$request->dtrmn_0_1:'1'?>" required>
                            </div>
                        </td>
                        <td class="{{ isset($request->dtrmn_slct_method) && $request->dtrmn_slct_method == '2' ? 'd-none' : '' }}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_0_2" class="input"  value="<?=isset($request->dtrmn_0_2)?$request->dtrmn_0_2:'9'?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->dtrmn_slct_method; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'dtrmn_0_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'dtrmn_0_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_1_0" class="input" value="<?=isset($request->dtrmn_1_0)?$request->dtrmn_1_0:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_1_1" class="input"  value="<?=isset($request->dtrmn_1_1)?$request->dtrmn_1_1:'5'?>"  required>
                            </div>
                        </td>
                        <td class="{{ isset($request->dtrmn_slct_method) && $request->dtrmn_slct_method == '2' ? 'd-none' : '' }}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_1_2" class="input"  value="<?=isset($request->dtrmn_1_2)?$request->dtrmn_1_2:'1'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->dtrmn_slct_method; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'dtrmn_1_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'dtrmn_1_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr class="{{ isset($request->dtrmn_slct_method) && $request->dtrmn_slct_method == '2' ? 'd-none' : '' }}">
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_2_0" class="input" value="<?=isset($request->dtrmn_2_0)?$request->dtrmn_2_0:'1'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_2_1" class="input"  value="<?=isset($request->dtrmn_2_1)?$request->dtrmn_2_1:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_2_2" class="input"  value="<?=isset($request->dtrmn_2_2)?$request->dtrmn_2_2:'7'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->dtrmn_slct_method; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'dtrmn_2_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'dtrmn_2_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @isset($request->submit)
                        @for ($i = 3; $i < $request->dtrmn_slct_method; $i++)
                            <tr>
                                @for ($j = 0; $j < $request->dtrmn_slct_method; $j++)
                                    <td>
                                        <div class="px-1 pt-2">
                                            @php $mat = 'dtrmn_'.$i.'_'. $j; @endphp
                                            <input type="number" step="any" name="{{ 'dtrmn_' . $i . '_' . $j }}" class="input" value="{{$request->$mat}}" required>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    @endisset
                </table>
            </div>
            <div class="col-span-12 ">
                <button type="button" id="dtrmn_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['2']?></button>
                <button type="button" id="dtrmn_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['3']?></button>
            </div>
            <div class="col-span-12">
                <label for="dtrmn_opts_method" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <select id="dtrmn_opts_method" name="dtrmn_opts_method" class="input">
                        <?php
                            $name = [$lang['5'],$lang['6']];
                            $val = ["exp_col","exp_row"];
                            optnsList($val,$name,"exp_col",$request->dtrmn_opts_method);
                        ?>
                    </select>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full overflow-auto">
                                <?php
                                if ($detail['det']==0) {
                                    ?>
                                    <p class="mt-2 font-s-18"><b><?php echo $detail['inverse'] ;?></b></p>
                                    <?php
                                }else if ($detail['det'] != 0) {
                                    ?>
                                    <p class="mt-2 font-s-18"><b>
                                        \( \begin{bmatrix}
                                        <?php
                                        foreach ($detail['inverse'] as $value3) {
                                          $k=0;
                                          foreach ($value3 as  $value4) {
                                             if ($k!=0) {
                                              echo "&";
                                            }
                                            $k++;
                                            echo $value4;
                                          }
                                          ?>
                                          \\
                                          <?php 
                                        }
                                        ?>
                                        \end{bmatrix} \)
                                    </b></p>
                                    <?php
                                }
                                ?>
                                <p class="mt-3"><?=$lang[8]?></p>
                                <?php
                                    if ($request->dtrmn_opts_method=="exp_col") {
                                    ?>
                                    <p class="mt-3">
                                    \( Calculate \begin{bmatrix}
                                        <?php
                                        foreach ($detail['zain'] as $value) {
                                          $k=0;
                                          foreach ($value as  $value2) {
                                             if ($k!=0) {
                                              echo "&";
                                            }
                                            $k++;
                                            echo $value2;
                                          }
                                          ?>
                                          \\
                                          <?php 
                                        }
                                        ?>
                                    \end{bmatrix} ^ \text{-1} \text{<?=$lang[9]?> Gauss-Jordan Elimination <?=$lang[10]?>.} \)
                                    </p>
                                    <p class="mt-3"><strong><?=$lang[14]?>:</strong></p>
                                    <p class="mt-3"><?=$lang[11]?> <a href="https://calculator-online.net/determinant-calculator/" class="text-blue" target="_blank">Determinant Calculator</a>) </p>
                                            <p class="mt-3">
                                            \( D = \begin{vmatrix}
                                            <?php
                                            foreach ($detail['zain'] as $value) {
                                              $k=0;
                                              foreach ($value as  $value2) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                echo $value2;
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{vmatrix} = <?=$detail['det']?> \)
                                            </p>
                                            <?php
                                            if ($detail['det']==0) {
                                                ?>
                                                <p class="mt-3"><?=$lang[12]?>.</p>
                                                <?php
                                            }else if ($detail['det'] != 0) {
                                                ?>
                                                <p class="mt-3"><?=$lang[13]?></p>
                                                <p class="mt-3">
                                                  <?php
                                                for ($i = 0; $i < count($detail['swap_line']); ++$i) {
                                                      ?> <p class="mt-3"><?php echo $detail['swap_line'][$i]; ?></p><?php
                                                      ?> 
                                                      \(
                                                      \left[
                                                      \begin{array}{<?php for($k=0; $k < $request->dtrmn_slct_method; $k++) { 
                                                        echo "c";
                                                      } ?>|<?php for ($j=0; $j < $request->dtrmn_slct_method; $j++) { 
                                                          echo "c";
                                                      } ?>}<?php
                                                      foreach ($detail['swap'][$i] as $key => $value) {
                                                        $k=0;
                                                        foreach ($value as  $value2) {
                                                          if ($k!=0) {
                                                            echo "&";
                                                          }
                                                          $k++;
                                                          $tt = explode('.', $value2);
                                                          if (count($tt)==1) {
                                                              echo $value2;
                                                          }else if (count($tt)==2) {
                                                              echo (number_format($value2, 3));
                                                          }
                                                        }
                                                        ?>
                                                        \\
                                                        <?php 
                                                      }
                                                      ?>
                                                      \end{array}
                                                      \right]
                                                      \)   
                                                      <?php
                                                    }
                                                  ?>
                                                </p>
                                                <?php
                                            }							
                                    }else if ($request->dtrmn_opts_method=="exp_row") {
                                        ?>
                                            <p class="mt-3">
                                            \( Calculate \begin{bmatrix}
                                                <?php
                                                foreach ($detail['zain'] as $value) {
                                                  $k=0;
                                                  foreach ($value as  $value2) {
                                                     if ($k!=0) {
                                                      echo "&";
                                                    }
                                                    $k++;
                                                    echo $value2;
                                                  }
                                                  ?>
                                                  \\
                                                  <?php 
                                                }
                                                ?>
                                            \end{bmatrix} ^ \text{-1} \text{<?=$lang[9]?> adjugate method.} \)
                                            </p>  
                                            <p class="mt-3"><?=$lang[14]?>:</p>
                                            <p class="mt-3"><?=$lang[11]?> <a href="https://calculator-online.net/determinant-calculator/" class="text-blue" target="_blank">Determinant Calculator</a>) </p>
                                            <p class="mt-3">
                                            \( D = \begin{vmatrix}
                                            <?php
                                            foreach ($detail['zain'] as $value) {
                                              $k=0;
                                              foreach ($value as  $value2) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                echo $value2;
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{vmatrix} = <?=$detail['det']?> \)
                                            </p>
                                            <?php
                                            if ($detail['det']==0) {
                                                ?>
                                                <p class="mt-3"><?=$lang[12]?>.</p>
                                                <?php
                                            }else if ($detail['det'] != 0) {
                                                ?>
                                                <p class="mt-3"><?=$lang[15]?>:</p>
                                            <?php foreach ($detail['c_down'] as $index => $value) {
                                                ?>
                                                <p class="mt-3">\( C_\text{<?php echo $detail['c_down'][$index] ;?>} = (-1)^\text{<?php echo $detail['minus_pow'][$index] ;?>} \begin{vmatrix} <?php
                                                foreach ($detail['all_cofy'][$index] as $key => $value) {
                                                  $k=0;
                                                  foreach ($value as  $value2) {
                                                     if ($k!=0) {
                                                      echo "&";
                                                    }
                                                    $k++;
                                                    echo $value2;
                                                  }
                                                  ?>
                                                  \\
                                                  <?php 
                                                } 
                                                ;?> \end{vmatrix} = <?php echo $detail['allcofy_det'][$index]; ?> \) (<?=$lang[21]?> <a href="https://calculator-online.net/determinant-calculator/" class="text-blue" target="_blank">Determinant Calculator</a>)</p>
                                                <?php
                                            }
                                            ?>
                                            <p class="mt-3"><?=$lang[16]?>:</p>
                                            \( \begin{bmatrix}
                                            <?php
                                            foreach ($detail['final_cofa'] as $value3) {
                                              $k=0;
                                              foreach ($value3 as  $value4) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                echo $value4;
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{bmatrix} \)
                                            <p class="mt-3"><?=$lang[17]?>:</p>
                                            \( \begin{bmatrix}
                                            <?php
                                            foreach ($detail['ans_tran'] as $value3) {
                                              $k=0;
                                              foreach ($value3 as  $value4) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                echo $value4;
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{bmatrix} \)
                                            <p class="mt-3"><?=$lang[18]?>:</p>
                                            \( \begin{bmatrix}
                                            <?php
                                            foreach ($detail['ans_tran'] as $value3) {
                                              $k=0;
                                              foreach ($value3 as  $value4) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                echo $value4;
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{bmatrix} \)
                                            <p class="mt-3"><?=$lang[19]?>.</p>
                                            \( \begin{bmatrix}
                                            <?php
                                            foreach ($detail['ans_tran'] as $value3) {
                                              $k=0;
                                              foreach ($value3 as  $value4) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                ?>
                                                \dfrac{<?php echo $value4; ?>}{<?php echo $detail['det']; ?>}
                                                <?php
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{bmatrix} \)
                                            <p class="mt-3"><?=$lang[20]?>:</p>
                                            \( \begin{bmatrix}
                                            <?php
                                            foreach ($detail['inverse'] as $value3) {
                                              $k=0;
                                              foreach ($value3 as  $value4) {
                                                 if ($k!=0) {
                                                  echo "&";
                                                }
                                                $k++;
                                                echo $value4;
                                              }
                                              ?>
                                              \\
                                              <?php 
                                            }
                                            ?>
                                            \end{bmatrix} \)
                                                <?php
                                            }
                                            ?>
                                        <?php
                                    }
                                    ?>
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
            document.getElementById('dtrmn_gen_btn').addEventListener('click', function() {
                var arr = [];
                for (var i = 0; i < 25; ++i) {
                    arr[i] = i;
                }
                arr = randNums(arr);
                var inputs = document.querySelectorAll('.dtrmn_mtrx_tbl > tbody > tr > td > div > input');
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
            document.getElementById('dtrmn_clr_btn').addEventListener('click', function() {
                var inputs = document.querySelectorAll('.dtrmn_mtrx_tbl > tbody > tr > td > div > input');
                inputs.forEach(function(input) {
                    input.value = "";
                });
            });
            function crDetMatrix(mat) {
                var matrixOptVal = mat.value;
                var matrixTableBody = document.querySelector(".dtrmn_mtrx_tbl > tbody");
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
                            input.name = "dtrmn_" + index + "_" + matrixTdLens;
                            input.value = "0";
                            input.id = "dtrmn_" + index + "_" + matrixTdLens;
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
            document.querySelectorAll(".dtrmn_mtrx_slct").forEach(function(element) {
                element.addEventListener("change", function() {
                    crDetMatrix(element);
                });
            });
        </script>
    @endpush
</form>
