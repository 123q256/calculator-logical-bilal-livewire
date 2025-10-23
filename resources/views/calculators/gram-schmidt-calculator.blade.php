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
            <p class="col-span-12 text-[16px]"><strong><?=$lang[1]?></strong></p>
            <div class="col-span-3">
                <select name="matrix2" class="input input1" id="rows2" aria-label="select">
                    <?php
                    function optnsList($arr1,$arr2,$frst,$method){
                        foreach($arr1 as $index => $name){
                    ?>
                    <option value="<?php echo $name ?>" <?php if(isset($method)){ echo $name === $method ? " selected" : ""; }else{ echo $name === $frst ? " selected" : ""; } ?>><?php echo $arr2[$index] ?></option>
                    <?php
                        }}
                    $name = ["1","2","3","4","5","6","7","8","9","10"];
                    $val = ["1","2","3","4","5","6","7","8","9","10"];
                    optnsList($val,$name,"2",$request->matrix2);
                    ?>
                </select>
            </div>
            <p class="col-span-1 text-[16px]"><strong>X</strong></p>
            <div class="col-span-3">
                <select name="matrix22" class="input input2" id="columns2" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                    optnsList($val,$name,"2",$request->matrix22);
                    ?>
                </select>
            </div>
            <p class="col-span-12 text-[16px]"><strong><?=$lang[3]?></strong></p>
            <div class="col-span-12">
                <table id="matrix2">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix31_1" class="input" value="<?=isset($request->matrix31_1)?$request->matrix31_1:'3'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix31_2" class="input"  value="<?=isset($request->matrix31_2)?$request->matrix31_2:'5'?>" required>
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
                                <input type="number" step="any" name="matrix32_1" class="input" value="<?=isset($request->matrix32_1)?$request->matrix32_1:'7'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix32_2" class="input"  value="<?=isset($request->matrix32_2)?$request->matrix32_2:'9'?>"  required>
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
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-[16px]">
                                <p class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 text-[18px] ">
                                    \(
                                    \begin{bmatrix}
                                      <?php
                                      foreach ($detail['first_unit'] as  $value4) {
                                        echo $value4;
                                        ?>
                                        \\
                                        <?php
                                      }
                                      ?>
                                    \end{bmatrix}
                                    <?php
                                    foreach ($detail['all_vecunit'] as $values) {
                                      ?>
                                      \begin{bmatrix}
                                      <?php
                                      foreach ($values as  $values2) {
                                        echo $values2;
                                        ?>
                                        \\
                                        <?php
                                      } 
                                      ?>
                                      \end{bmatrix}
                                      <?php 
                                    }
                                    ?>
                                    \)
                                </p>
                                <p class="mt-2 text-[18px]"><strong><?=$lang[5]?></strong></p> 
                                <p class="mt-2 ">
                                    <?=$lang[6]?>
                                    \(
                                        <?php
                                        $k=1;
                                        foreach ($detail['all_vec'] as $value3) {
                                            echo "V_".$k." =";
                                            $k++;
                                            ?>
                                            \begin{bmatrix}
                                            <?php
                                            foreach ($value3 as  $value4) {
                                            echo $value4;
                                            ?>
                                            <?php
                                            } 
                                            ?>
                                            \end{bmatrix} ,
                                            <?php 
                                        }
                                        ?>
                                    \)
                                    <?=$lang[7]?>.
                                </p>
                                <p class="mt-2 text-[18px]"><strong>Step by Step <?=$lang[8]?>:</strong></p>
                                <div class="bg-[#F6FAFC] border radius-10 px-3 py-2 mt-2 ">
                                    <p class="mt-2 overflow-auto">
                                        {{-- \(
                                        \text{<?=$lang[9]?>,} \ \vec{u_k} = \vec{v_k} - \Sigma_{j-1}^\text{k-1} \ proj_\vec{uj} \ (\vec{v_k}) \ \text{<?=$lang[10]?>} \ proj_\vec{uj} \  (\vec{v_k}) = \frac{ \vec{u_j} \cdot \vec{v_k}}{|{\vec{u_j}}|^2} \vec{u_j} \ \text{​<?=$lang[11]?> .}
                                        \) --}}
                                        \(
                                        \text{<?=$lang[9]?>,} \ \vec{u_k} = \vec{v_k} - \sum_{j=1}^{k-1} \text{proj}_{\vec{u_j}}(\vec{v_k}) \quad \text{<?=$lang[10]?>} \quad \text{proj}_{\vec{u_j}}(\vec{v_k}) = \frac{\vec{u_j} \cdot \vec{v_k}}{|\vec{u_j}|^2} \vec{u_j} \quad \text{<?=$lang[11]?>.}
                                        \)
                
                                    </p>
                                    <p class="mt-2">
                                        \(
                                        \text{<?=$lang[12]?>} \ \vec{e_k} = \frac{ \vec{u_k}}{|{\vec{u_k}}|}
                                        \)
                                    </p>
                                    <p class="mt-2 font-s-18"><strong><?=$lang[13]?> 1</strong></p>
                                    <p class="mt-2">
                                        \(
                                        \vec{u_1} \ = \ \vec{v_1} \ = \ \begin{bmatrix}
                                        <?php
                                        foreach ($detail['all_vec'][0] as  $value4) {
                                            echo $value4;
                                            ?>
                                            \\
                                            <?php
                                        }
                                        ?>
                                        \end{bmatrix}
                                        \)
                                    </p>
                                    <p class="mt-2"><?=$lang[14]?> <a href="https://technical-calculator.com/unit-vector-calculator/" class="text-blue-500 underline" target="_blank">Unit Vector Calculator</a>) </p>
                                    <p class="mt-2">
                                        \(
                                        \vec{u_1} \ = \ \vec{v_1} \ = \ \begin{bmatrix}
                                        <?php
                                        foreach ($detail['first_unit'] as  $value4) {
                                            echo $value4;
                                            ?>
                                            \\
                                            <?php
                                        }
                                        ?>
                                        \end{bmatrix} \)
                                    </p>
                                    <p class="mt-2">
                                        <?php
                                        for ($n=0; $n < count($detail['pros_ans']); $n++) {
                                        echo "<p class='mt-2 font-s-18 fw-bold'>".$lang[13]." ".($n+2)."</p>";
                                        ?>
                                        <p class='mt-2'>
                                            <?=$lang[15]?> <a href="https://technical-calculator.com/vector-projection-calculator/" class="text-blue-500 underline" target="_blank">Vector Projection Calculator</a>)
                                            \(
                                                \text{proj}_{\vec{u_1}}(\vec{v_{<?= ($n+2) ?>}}) 
                                                <?php if ($n != 0) { ?>
                                                - \text{proj}_{\vec{u_2}}(\vec{v_{<?= ($n+2) ?>}})
                                                <?php } ?> =
                                                \begin{bmatrix}
                                                <?php
                                                foreach ($detail['pros_ans'][$n] as $value4) {
                                                    echo round($value4, 2) . " \\\\ ";
                                                }
                                                ?>
                                                \end{bmatrix} \\
                                                \)
                
                                        </p>
                                        <p class="mt-2">
                                            <?=$lang[16]?>:
                                        </p>
                                        <p class="mt-2">
                                            \(
                                                \vec{u_{<?=($n+2)?>}} = \vec{v_{<?=($n+2)?>}} - \text{proj}_{\vec{u_1}}(\vec{v_{<?=($n+2)?>}}) 
                                                <?php if ($n != 0) { ?>
                                                - \text{proj}_{\vec{u_2}}(\vec{v_{<?=($n+2)?>}})
                                                <?php } ?> = 
                                                \begin{bmatrix}
                                                <?php
                                                foreach ($detail['subtract'][$n] as $value3) {
                                                    echo round($value3, 2) . " \\\\ ";
                                                }
                                                ?>
                                                \end{bmatrix}
                                                \)
                
                                        </p>
                                        <p class="mt-2">
                                            <?=$lang[14]?>
                                        </p>
                                        <p class="mt-2">
                                            \( 
                                            \vec{e_<?= ($n+2) ?>} = \frac{ \vec{u_<?= ($n+2) ?>}}{|{\vec{u_<?= ($n+2) ?>}}|} \ = \
                                            \begin{bmatrix}
                                            <?php
                                            foreach ($detail['all_vecunit'][$n] as  $value3) {
                                                echo round($value3, 2);
                                                ?>
                                                \\
                                                <?php
                                            } 
                                            ?>
                                            \end{bmatrix}
                                            \)
                                        </p>
                                        <?php
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
            @endif

            document.querySelectorAll('.input1, .input2').forEach(function(element) {
                element.addEventListener('change', function() {
                    var rows2 = document.getElementById("rows2").value;
                    var columns2 = document.getElementById("columns2").value;
                    var rowCount2 = document.getElementById("matrix2").getElementsByTagName("tr").length;
                    var matrix2 = document.getElementById("matrix2");
                    if (rows2 > rowCount2) {
                        for (var k = 1; k <= rows2 - rowCount2; k++) {
                            var newRow2 = matrix2.insertRow();
                        }
                    } else if (rows2 < rowCount2) {
                        for (var i = 1; i <= rowCount2 - rows2; i++) {
                            matrix2.deleteRow(-1);
                        }
                    }
                    var rowsMatrix2 = matrix2.getElementsByTagName("tr");
                    for (var row2 = 0; row2 < rowsMatrix2.length; row2++) {
                        var cols2 = rowsMatrix2[row2].getElementsByTagName("td").length;
                        if (columns2 > cols2) {
                            for (var i = cols2 + 1; i <= columns2; i++) {
                                var newCell2 = rowsMatrix2[row2].insertCell();
                                newCell2.innerHTML = '<div class="px-1 pt-2">' +
                                    '<input type="number" step="any" name="matrix3' + (row2 + 1) + '_' + i + '" class="input" value="" required>' +
                                    '</div>';
                            }
                        } else if (cols2 > columns2) {
                            for (var i = 1; i <= cols2 - columns2; i++) {
                                rowsMatrix2[row2].deleteCell(-1);
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</form>
