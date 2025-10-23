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
            <p class="col-span-12   mt-0 mt-lg-2 text-[16px] text-blue px-1"><strong><?=$lang[1]?></strong></p>
            <div class="col-span-2 ">
                <select name="matrix2" class="input" id="rows2" aria-label="select">
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
                    optnsList($val,$name,"2",$request->matrix2);
                    ?>
                </select>
            </div>
            <p class="col-span-1  mt-3 text-[16px] text-center px-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select name="matrix22" class="input" id="columns2" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                    optnsList($val,$name,"2",$request->matrix22);
                    ?>
                </select>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 my-auto ps-2">
                <button type="button" name="submit" id="btn2" title="Add More Fields" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang[2]?></button>
            </div>
            <p class="col-span-12   mt-0 mt-lg-2 text-[16px] text-blue px-1"><strong><?=$lang[3]?></strong></p>
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
                        <div class="w-full text-[16px] overflow-auto">
                            <p class="mt-2 text-[18px]">
                                \( \begin{bmatrix}
                                <?php
                                foreach ($detail['jawab'] as $value3) {
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
                            </p>
                            <p class="mt-2"><strong><?=$lang[6]?></strong></p>
                            <p class="mt-2"><?=$lang[5]?></p>
                            <p class="mt-2">
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
                            \end{bmatrix} ^ \text{T} = \text{ ?} \)
                            </p>
                            <p class="mt-2"><?=$lang[7]?>.</p>
                            <p class="mt-2">
                            \(  \text{<?=$lang[8]?>} \begin{bmatrix}
                            <?php
                                foreach ($detail['jawab'] as $value) {
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
                            \end{bmatrix} \)
                            </p>
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
            document.getElementById("btn2").addEventListener("click", function() {
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
        </script>
    @endpush
</form>
