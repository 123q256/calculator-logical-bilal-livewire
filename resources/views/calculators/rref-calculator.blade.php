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
            <p class="col-span-12 text-[16px] text-blue px-1"><strong><?=$lang[1]?>:</strong></p>
            <div class="col-span-3">
                <input type="number" min="1" max="10" onchange="addFields()" id="rows2" name="matrix2" class="input" value="<?=isset($request->matrix2)?$request->matrix2:'2'?>"  required>
            </div>
            <p class="col-span-1 mt-3 text-[16px] text-center px-1"><strong>X</strong></p>
            <div class="col-span-3">
                <input type="number" min="1" max="10" onchange="addFields()" id="columns2" name="matrix22" class="input" value="<?=isset($request->matrix22)?$request->matrix22:'2'?>"  required>
            </div>
            <p class="col-span-12 text-[16px] text-blue px-1"><strong><?=$lang[3]?></strong></p>
            <div class="col-span-12">
                <table class="w-100" id="matrix2">
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
                    @php
                        $matrix2= $request->matrix2;
                        $matrix22= $request->matrix22;
                        function gcd2($a, $b, $f) {
                            if( $f ){
                                if ( $b<=1 )
                                return $a;
                            }else{
                                if ( !$b )
                                return $a;
                            }
                            return gcd2($b, $a % $b, $f);
                            }
                            function roundresult($x){
                            $y=floatval($x);
                            $y=roundnum($y,10);
                            return $y;
                            }
                            function toPrecision($number, $precision) {
                            if ($number == 0) return 0;
                            $exponent = floor(log10(abs($number)) + 1);
                            $significand =round(($number / pow(10, $exponent))* pow(10, $precision))/ pow(10, $precision);
                            return $significand * pow(10, $exponent);
                            }
                            function roundnum($x,$p){
                            $n=floatval($x);
                            $m=toPrecision($n,($p+1));
                            $y=strval($m);
                            $i=strpos($y,'e');
                            if($i==-1)
                                $i=strlen($y);
                            $j=strpos($y,'.');
                            return $y;
                            }
                            function digits_after_period($x){
                            $f = strval($x);
                            $i = strpos($f,'.');
                            $len = strlen($f)-$i-1;
                            return $len;
                            }
                            function convert($xelem){
                            $sign = '';
                            $sign2 = '+';
                            $f=false;
                            $x = $xelem;
                            $x2 = roundresult($x);
                            $absx=abs($x2);
                            $y=floor($absx);
                            $frac=($absx-$y);
                            if( $x2<0 ) 
                                $sign = $sign2 = '-';
                            $d = digits_after_period($absx);
                            $den = round(pow(10,$d));
                            $num = round($frac * $den);
                            $a12=strval($num);
                            $len=strlen($a12);
                            if( $len>8 ) $f=true;
                            $g = gcd2($num,$den,$f);
                            $num2 = round($num / $g);
                            $den2 = round($den / $g);
                            $txt=$x2." ";
                            $txt.=$num."/".$den;
                            $top_jawab=$sign.($num2+$den2*$y);
                            $down_jawab=$den2;
                            return array($top_jawab,$down_jawab);
                            } 
                    @endphp
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-2 text-[18px]"><strong><?=$lang[4]?></strong></p>
                            <p class="mt-2">
                                \( \begin{bmatrix}<?php
                                foreach ($detail['matrix'] as $key => $value) {
                                    $k=0;
                                    foreach ($value as  $value2) {
                                    if ($k!=0) {
                                        echo "&";
                                    }
                                    $k++;
                                    if (is_numeric($value2)) {
                                        if ($value2==0) {
                                        echo "0";
                                        }else{
                                        echo ($value2);
                                        }
                                    }else if (!is_float($value2)) {
                                        $jawab=convert($value2);
                                        echo $top_jawab."/".$down_jawab;
                                    }
                                    }
                                    ?>
                                    \\
                                    <?php 
                                }
                                ?>
                                \end{bmatrix} \)
                            </p>
                            <p class="mt-2"><strong><?=$lang[5]?></strong></p>
                            <p class="mt-2"><?=$lang[6]?>:</p>
                            <p class="mt-2">
                                \( \begin{bmatrix}
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
                                \end{bmatrix} \)
                            </p>
                            <p class="mt-2"><?=$lang[7]?>:</p>
                                {{-- <p class="mt-2">
                                <?php
                                for ($i = 0; $i < count($detail['swap_line']); ++$i) {
                                    ?> <p class="mt-2"><?php echo $detail['swap_line'][$i]; ?></p><?php
                                    ?> 
                                    \begin{bmatrix}
                                    <?php
                                    foreach ($detail['swap'][$i] as $key => $value) {
                                    $k=0;
                                    foreach ($value as  $value2) {
                                        if ($k!=0) {
                                        echo "&";
                                    }
                                    $k++;
                                    $jawab=convert($value2);
                                    if ($jawab[1]==1) {
                                        if ($value2==0) {
                                        echo "0";
                                        }else{
                                        echo ($value2);
                                        }
                                    }else if ($jawab[1]!=1) {                          
                                        ?> 
                                        \frac{<?php echo $jawab[0];?>}{<?php echo $jawab[1];?>}
                                        <?php
                                    }
                                    }
                                    ?>
                                    \\
                                    <?php 
                                }
                                ?>
                                \end{bmatrix}
                                <?php
                                }
                                ?>
                            </p> --}}
                            <p class="mt-2">
                                <?php
                                for ($i = 0; $i < count($detail['swap_line']); ++$i) {
                                    echo '<p class="mt-2">' . $detail['swap_line'][$i] . '</p>';  
                                    echo '\( \begin{bmatrix}';
                                    foreach ($detail['swap'][$i] as $key => $value) {
                                        $k = 0;
                                        foreach ($value as $value2) {
                                            if ($k != 0) {
                                                echo "&";
                                            }
                                            $k++;
                                            $jawab = convert($value2);
                                            if ($jawab[1] == 1) {
                                                if ($value2 == 0) {
                                                    echo "0";
                                                } else {
                                                    echo $value2;
                                                }
                                            } else {
                                                echo '\frac{' . $jawab[0] . '}{' . $jawab[1] . '}';
                                            }
                                        }
                                        echo '\\\\';
                                    }
                                    echo '\end{bmatrix} \)';
                                }
                                ?>
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
            function addFields() {
                var counter = 1;
                var rows2 = document.getElementById("rows2").value;
                var columns2 = document.getElementById("columns2").value;
                var rowCount2 = document.getElementById('matrix2').getElementsByTagName('tr').length;
                var row = 0;
                if (rows2 > rowCount2) {
                    for (var k = 1; k <= rows2 - rowCount2; k++) {
                    var newRow2 = document.createElement('tr');
                    document.getElementById('matrix2').appendChild(newRow2);
                    }
                } else if (rows2 < rowCount2) {
                    for (var i = 1; i <= rowCount2 - rows2; i++) {
                    var table2 = document.getElementById('matrix2');
                    table2.removeChild(table2.lastElementChild);
                    }
                }

                var row2 = 0;
                var matrix2Rows = document.getElementById('matrix2').getElementsByTagName('tr');
                Array.prototype.forEach.call(matrix2Rows, function(tr) {
                    row2++;
                    var colCount2 = tr.getElementsByTagName('td').length;
                    if (columns2 > colCount2) {
                    for (var i = (colCount2 + 1); i <= columns2; i++) {
                        var newTd2 = document.createElement('td');
                        newTd2.innerHTML = 
                        '<div class="px-1 pt-2">' +
                        '<input type="number" step="any" name="matrix3' + row2 + '_' + i + '" class="input" value="" required>' +
                        '</div>';
                        tr.appendChild(newTd2);
                    }
                    } else if (colCount2 > columns2) {
                    for (var i = 1; i <= colCount2 - columns2; i++) {
                        tr.removeChild(tr.lastElementChild);
                    }
                    }
                });
                }
        </script>
    @endpush
</form>
