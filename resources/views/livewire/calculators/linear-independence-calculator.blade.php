<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ row: @entangle('data.row').live, colum: @entangle('data.colum').live }">
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
                    <select wire:model.live="data.row" class="input" id="row" aria-label="select">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                                <label for="colum" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <select wire:model.live="data.colum" class="input" id="colum" aria-label="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
                        <div class="col-span-12">
                <table class="matrix_table w-full">
                    @for ($i = 0; $i < 4; $i++)
                        <tr x-show="row > {{ $i }}">
                            @for ($j = 0; $j < 4; $j++)
                                <td x-show="colum > {{ $j }}">
                                    <div class="px-1 pt-2">
                                        <input type="number" step="any" wire:model.live="data.matrix_{{ $i }}_{{ $j }}" class="input" x-bind:required="row > {{ $i }} && colum > {{ $j }}">
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
            <div class="col-span-12">
                <button type="button" id="linear_indep_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['3']?></button>
                <button type="button" id="linear_indep_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['4']?></button>
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
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  mt-3">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[18px]"><strong id="ans">{{ $detail['status'] ?? '' }}</strong></p>
                            <?php 
                            if ($detail['row']==2 && $detail['colum']==2) {
                                $a1=$data['matrix_0_0'];
                                $a2=$data['matrix_0_1'];
                                $b1=$data['matrix_1_0'];
                                $b2=$data['matrix_1_1'];
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
                                $a1=$data['matrix_0_0'];
                                $a2=$data['matrix_0_1'];
                                $a3=$data['matrix_0_2'];
                                $b1=$data['matrix_1_0'];
                                $b2=$data['matrix_1_1'];
                                $b3=$data['matrix_1_2'];
                                $c1=$data['matrix_2_0'];
                                $c2=$data['matrix_2_1'];
                                $c3=$data['matrix_2_2'];
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });
            });
        </script>
        
                <script>
            document.getElementById('linear_indep_gen_btn').addEventListener('click', function() {
                var arr = [];
                for (var i = 0; i < 25; ++i) {
                    arr[i] = i;
                }
                arr = randNums(arr);
                var inputs = document.querySelectorAll('.matrix_table > tbody > tr > td > div > input');
                inputs.forEach(function(input, index) {
                    if (input.offsetHeight > 0) {
                        input.value = String(arr[index]).charAt(0);
                        input.dispatchEvent(new Event('input'));
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
            document.getElementById('linear_indep_clr_btn').addEventListener('click', function() {
                var inputs = document.querySelectorAll('.matrix_table > tbody > tr > td > div > input');
                inputs.forEach(function(input) {
                    input.value = "";
                    input.dispatchEvent(new Event('input'));
                });
            });
        </script>
    @endpush
</form>

</div>
