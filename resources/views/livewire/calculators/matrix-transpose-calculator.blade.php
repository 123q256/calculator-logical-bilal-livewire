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
            <p class="col-span-12   mt-0 mt-lg-2 text-[16px] text-blue px-1"><strong><?=$lang[1]?></strong></p>
            <div class="col-span-2 ">
                <select wire:model.live="rows" name="matrix2" class="input" id="rows2" aria-label="select">
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
                    optnsList($val,$name,"2",$rows);
                    ?>
                </select>
            </div>
            <p class="col-span-1  mt-3 text-[16px] text-center px-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select wire:model.live="cols" name="matrix22" class="input" id="columns2" aria-label="select">
                    <?php
                        $name = ["1","2","3","4","5","6","7","8","9","10"];
                        $val = ["1","2","3","4","5","6","7","8","9","10"];
                    optnsList($val,$name,"2",$cols);
                    ?>
                </select>
            </div>
            <div class="col-span-12 mt-3">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">Generate Matrix</button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">Clear Matrix</button>
            </div>
            <p class="col-span-12 mt-0 mt-lg-2 text-[16px] text-blue px-1"><strong><?=$lang[3]?></strong></p>
            <div class="col-span-12">
                <table id="matrix2" class="w-full matrix_table">
                    @for ($i = 1; $i <= $rows; $i++)
                        <tr wire:key="row-{{ $i }}">
                            @for ($j = 1; $j <= $cols; $j++)
                                <td wire:key="col-{{ $i }}-{{ $j }}">
                                    <div class="px-1 pt-2">
                                        <input type="number" step="any" wire:model="matrix.{{ $i }}.{{ $j }}" name="{{ 'matrix3' . $i . '_' . $j }}" class="input w-full" required>
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
