<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                $request = request();
                if (session()->has('calculator_back_inputs')) {
                    $request->merge(session('calculator_back_inputs'));
                } else {
                    $request->merge([
                        'matrix2' => $rows,
                        'matrix22' => $columns,
                    ]);
                    for ($i = 1; $i <= $rows; $i++) {
                        for ($j = 1; $j <= $columns; $j++) {
                            $request->merge(['matrix3' . $i . '_' . $j => $matrix[$i . '_' . $j] ?? '']);
                        }
                    }
                }
            @endphp
            <p class="col-span-12 text-[16px] text-blue px-1"><strong><?=$lang[1]?>:</strong></p>
            <div class="col-span-3">
                <input type="number" min="1" max="10" id="rows2" name="matrix2" class="input" wire:model.live="rows" required>
            </div>
            <p class="col-span-1 mt-3 text-[16px] text-center px-1"><strong>X</strong></p>
            <div class="col-span-3">
                <input type="number" min="1" max="10" id="columns2" name="matrix22" class="input" wire:model.live="columns" required>
            </div>
            <p class="col-span-12 text-[16px] text-blue px-1"><strong><?=$lang[3]?></strong></p>
            <div class="col-span-12">
                <table class="w-100" id="matrix2">
                    @for ($i = 1; $i <= $rows; $i++)
                        <tr>
                            @for ($j = 1; $j <= $columns; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        <input type="number" step="any" class="input" wire:model="matrix.{{ $i }}_{{ $j }}" required>
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @php
                        $matrix2= $request->matrix2;
                        $matrix22= $request->matrix22;
                        if (!function_exists('gcd2')) {
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
                        }
                        if (!function_exists('roundresult')) {
                            function roundresult($x){
                                $y=floatval($x);
                                $y=roundnum($y,10);
                                return $y;
                            }
                        }
                        if (!function_exists('toPrecision')) {
                            function toPrecision($number, $precision) {
                                if ($number == 0) return 0;
                                $exponent = floor(log10(abs($number)) + 1);
                                $significand =round(($number / pow(10, $exponent))* pow(10, $precision))/ pow(10, $precision);
                                return $significand * pow(10, $exponent);
                            }
                        }
                        if (!function_exists('roundnum')) {
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
                        }
                        if (!function_exists('digits_after_period')) {
                            function digits_after_period($x){
                                $f = strval($x);
                                $i = strpos($f,'.');
                                $len = strlen($f)-$i-1;
                                return $len;
                            }
                        }
                        if (!function_exists('convert')) {
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
                        }
                    @endphp
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-2 text-[22px]"><strong><?=$lang[4]?></strong></p>
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
                                        echo $jawab[0]."/".$jawab[1];
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
            window.MJrerender = function() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }

            document.addEventListener('livewire:initialized', () => {
                if (typeof MJrerender === 'function') MJrerender();
                
                Livewire.hook('morph.updated', (el, component) => {
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                    }, 50);
                });
            });

            document.addEventListener('livewire:navigated', function () {
                if (typeof MJrerender === 'function') MJrerender();
            });

            document.addEventListener('DOMContentLoaded', function () {
                if (typeof MJrerender === 'function') MJrerender();
            });
        </script>
    @endpush
</form>

</div>
