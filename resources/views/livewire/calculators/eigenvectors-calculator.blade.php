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
            @endphp
            <div class="col-span-12">
                <label for="matrix" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select wire:model.live="matrix" id="matrix" name="matrix" class="input matrix">
                        <option value="2">2x2</option>
                        <option value="3">3x3</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <table class="w-100 matrix_table">
                    @for ($i = 0; $i < $matrix; $i++)
                        <tr>
                            @for ($j = 0; $j < $matrix; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        @php $mat = 'matrix_'.$i.'_'.$j; @endphp
                                        <input type="number" step="any" wire:model.live="{{ $mat }}" name="{{ $mat }}" class="input" required>
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
            <div class="col-span-12 ">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">{{ $lang['2'] }}</button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">{{ $lang['3'] }}</button>
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
                        @php
                            $eigvecs=$detail['eigvecs'];
                            $mul=$detail['mul'];
                            $eigvals=$detail['eigvals'];
                            $eigvals1=$detail['eigvals1'];
                            $eigvals2=$detail['eigvals2'];
                            if (isset($detail['eigvals3'])) {
                                $eigvals3=$detail['eigvals3'];
                            }
                            $d=$detail['d'];
                            $dtrmnt=$detail['dtrmnt'];
                            $l1=$detail['l1'];
                            $l2=$detail['l2'];
                            if (isset($detail['l3'])) {
                                $l3=$detail['l3'];
                            }
                            $a=$detail['a'];
                            $b=$detail['b'];
                            if (isset($detail['c'])) {
                                $c=$detail['c'];
                            }
                            $res1=$detail['res1'];
                            $res2=$detail['res2'];
                            if (isset($detail['res3'])) {
                                $res3=$detail['res3'];
                            }
                        @endphp
                        <div class="w-full text-[16px] overflow-auto">
                            <p class="mt-3 text-[18px]"><strong><?=$lang['4']?></strong></p>
                            @if($matrix == 2)
                                <p class="mt-3">\( \left(<?=$res1?>, <?=$res2?> \right) \)</p> 
                            @else
                                <p class="mt-3">\( \left(<?=$res1?>, <?=$res2?>, <?=$res3?> \right) \)</p>     
                            @endif
                            <p class="mt-3 text-[18px]"><strong><?=$lang['5']?></strong></p>
                            <p class="mt-3">\( <?=$mul?> \)</p>
                            <p class="mt-3 text-[18px]"><strong><?=$lang['6']?></strong></p>
                            @if($matrix == 2)
                                <p class="mt-3">\( (<?=$l1?>, <?=$l2?>) \)</p>
                            @else
                                <p class="mt-3">\( (<?=$l1?>, <?=$l2?>, <?=$l3?>) \)</p>
                            @endif
                            <p class="mt-3"><strong><?=$lang['7']?>:</strong></p>
                            <?php if($matrix == 2){ ?>
                                <p class="mt-3"><strong><?=$lang['8']?> λ <?=$lang['9']?></strong></p>
                                <p class="mt-3">\( <?=$d?> \)</p>
                                <p class="mt-3"><strong><?=$lang['10']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-3"><strong><?=$lang['11']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-3"><strong><?=$lang['12']?> (<?=$lang['6']?>)</strong></p>
                                <p class="mt-3">\( (\lambda1, \lambda2) = \left(<?=$l1?>, <?=$l2?>\right) \)</p>
                                <p class="mt-3"><strong><?=$lang['13']?> <?=$lang['4']?></strong></p>
                                <p class="mt-3">\( a. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals1)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res1?> \)</p>
                                <p class="mt-3">\( b. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals2)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res2?> \)</p>
                                <p class="mt-3"><strong><?=$lang['6']?></strong></p>
                                <p class="mt-3">\( <?=preg_replace('/frac/','dfrac',$eigvals)?> \approx (<?=$l1?>, <?=$l2?>) \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-3">\( <?=$mul?> \)</p>
                                <p class="mt-3"><strong><?=$lang['4']?></strong></p>
                                <p class="mt-3">\( <?=$eigvecs?> \approx \left(<?=$res1?>, <?=$res2?> \right) \)</p>
                            <?php }if($matrix == 3){ ?>
                                <p class="mt-3"><strong><?=$lang['8']?> λ <?=$lang['9']?></strong></p>
                                <p class="mt-3">\( <?=$d?> \)</p>
                                <p class="mt-3"><strong><?=$lang['10']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-3"><strong><?=$lang['11']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-3"><strong><?=$lang['12']?> (<?=$lang['6']?>)</strong></p>
                                <p class="mt-3">\( (\lambda1, \lambda2, \lambda3) = \left(<?=$l1?>, <?=$l2?>, <?=$l3?>\right) \)</p>
                                <p class="mt-3"><strong><?=$lang['13']?> <?=$lang['4']?></strong></p>
                                <p class="mt-3">\( a. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals1)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res1?> \)</p>
                                <p class="mt-3">\( b. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals2)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res2?> \)</p>
                                <p class="mt-3">\( c. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals3)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res3?> \)</p>
                                <p class="mt-3"><strong><?=$lang['6']?></strong></p>
                                <p class="mt-3">\( (<?=$l1?>, <?=$l2?>, <?=$l3?>) \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-3">\( <?=$mul?> \)</p>
                                <p class="mt-3"><strong><?=$lang['4']?></strong></p>
                                <p class="mt-3">\( \left(<?=$res1?>, <?=$res2?>, <?=$res3?> \right) \)</p>
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
                for (var i = 0; i < 25; ++i) {
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
