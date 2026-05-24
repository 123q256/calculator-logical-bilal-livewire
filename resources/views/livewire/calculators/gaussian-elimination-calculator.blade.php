<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[100%] md:w-[100%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                $request = request();
            @endphp
            <p class="col-span-12 text-[16px]  px-1"><strong><?=$lang[1]?></strong></p>
            <div class="col-span-2">
                <select wire:model.live="rows" name="matrix2" class="input" id="rows2" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-1  text-[16px] text-center px-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select wire:model.live="cols" name="matrix22" class="input" id="columns2" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-span-12 mt-3">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">Generate Matrix</button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">Clear Matrix</button>
            </div>
            <p class="col-span-12 text-[16px]  px-1"><strong><?=$lang[3]?></strong></p>
            <div class="col-span-12">
                <table id="matrix2" class="w-full matrix_table">
                    @for ($i = 0; $i < $rows; $i++)
                        <tr wire:key="row-{{ $i }}">
                            @for ($j = 0; $j < $cols; $j++)
                                <td wire:key="col-{{ $i }}-{{ $j }}">
                                    <div class="px-1 pt-2">
                                        <input type="number" step="any" wire:model.lazy="matrix.{{ $i }}.{{ $j }}" name="{{ 'matrix3' . ($i+1) . '_' . ($j+1) }}" class="input w-full" required>
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
                    <div class="w-full">
                        <div class="w-full text-[18px]">
                            @php
                                $matrix2 = $rows;
                                $matrix22 = $cols;
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
                                if(!function_exists('roundresult')){
                                    function roundresult($x){
                                    $y=floatval($x);
                                    $y=roundnum($y,10);
                                    return $y;
                                    }
                                }
                                if(!function_exists('toPrecision')){
                                    function toPrecision($number, $precision) {
                                    if ($number == 0) return 0;
                                    $exponent = floor(log10(abs($number)) + 1);
                                    $significand =round(($number / pow(10, $exponent))* pow(10, $precision))/ pow(10, $precision);
                                    return $significand * pow(10, $exponent);
                                    }
                                }
                                if(!function_exists('roundnum')){
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
                                if(!function_exists('digits_after_period')){
                                    function digits_after_period($x){
                                    $f = strval($x);
                                    $i = strpos($f,'.');
                                    $len = strlen($f)-$i-1;
                                    return $len;
                                    }
                                }
                                if(!function_exists('convert')){
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
                            <p class="mt-2  text-[18px]">
                                \(
                                \left[
                                \begin{array}{<?php for ($i=0; $i < $matrix22-1; $i++) { 
                                    echo "c";
                                } ?>|c}<?php
                                foreach ($detail['pz'] as $key => $value) {
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
                                \end{array}
                                \right]
                                \)
                            </p>
                            <p class="mt-2"><strong><?=$lang['5']?>:</strong></p>
                            <p class="mt-2"><?=$lang['6']?></p>
                            <p class="mt-2">
                                \(
                            \begin{bmatrix}
                            <?php
                            for ($i=0; $i <$rows;$i++) { 
                                for ($j=0; $j<$cols;$j++) { 
                                if($j<$cols-0 && ($j!==0)){
                                    ?>
                                    &
                                    <?php
                                }
                                $second_matrix = $matrix[$i][$j] ?? 0;
                                echo $second_matrix;
                                }
                                ?>
                                \\
                                <?php
                            }
                            ?>
                            \end{bmatrix} \)
                            </p>
                            <p class="mt-2"><strong><?=$lang['7']?></strong></p>
                            <p class="mt-2">
                            <?php
                            for ($i = 0; $i < count($detail['swap_line']); ++$i) {
                                ?> <p class="my-2"><?php echo $detail['swap_line'][$i]; ?></p><?php
                                ?> 
                                \(
                                \left[
                                \begin{array}{<?php for($k=0; $k < $matrix22-1; $k++) { 
                                    echo "c";
                                } ?>|c}<?php
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
                                \end{array}
                                \right]
                                \)  
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
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });

            document.getElementById('matrix_gen_btn').addEventListener('click', function() {
                var arr = [];
                for (var i = 0; i < 100; ++i) {
                    arr[i] = i;
                }
                arr = randNums(arr);
                var inputs = document.querySelectorAll('.matrix_table > tbody > tr > td > div > input');
                inputs.forEach(function(input, index) {
                    if (arr[index] !== undefined) {
                        input.value = String(arr[index]).charAt(0);
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    }
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
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                });
            });
        </script>
    @endpush
</form>

</div>
