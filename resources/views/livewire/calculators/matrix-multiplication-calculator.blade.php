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
            <p class="col-span-12"><strong><?=$lang['1']." A ".$lang['2']?>:</strong></p>
            <div class="col-span-2">
                <select wire:model.live="rows1" name="rows1" class="input" id="rows1" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select wire:model.live="columns1" name="columns1" class="input" id="columns1" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-12"><strong><?=$lang['1']." B ".$lang['2']?></strong></p>
            <div class="col-span-2">
                <select wire:model.live="matrix2" name="matrix2" class="input" id="rows2" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-1"><strong>X</strong></p>
            <div class="col-span-2">
                <select wire:model.live="matrix22" name="matrix22" class="input" id="columns2" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-span-12 mt-3">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">Generate Matrix</button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg">Clear Matrix</button>
            </div>
            <p class="col-span-12"><strong><?=$lang['1']?> A</strong></p>
            <div class="col-span-12">
                <table id="matrix1" class="matrix_table">
                    @for ($i = 0; $i < $rows1; $i++)
                        <tr>
                            @for ($j = 0; $j < $columns1; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        @php $mat = 'matrixA.'.$i.'.'.$j; @endphp
                                        <input type="number" step="any" wire:model.defer="{{ $mat }}" name="matrix{{$i+1}}_{{$j+1}}" class="input" required>
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
            <p class="col-span-12"><strong><?=$lang['1']?> B</strong></p>
            <div class="col-span-12">
                <table id="matrix2" class="matrix_table">
                    @for ($i = 0; $i < $matrix2; $i++)
                        <tr>
                            @for ($j = 0; $j < $matrix22; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        @php $mat = 'matrixB.'.$i.'.'.$j; @endphp
                                        <input type="number" step="any" wire:model.defer="{{ $mat }}" name="matrix3{{$i+1}}_{{$j+1}}" class="input" required>
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
        <div class="w-full mt-3 overflow-x-auto">
            <div class="w-full">
                <div class="w-full text-[16px]">
                    <p class="mt-2 text-[18px]">\( \begin{bmatrix}<?php
                        $result=array();
                        for($i=0;$i<$rows1;$i++){
                          for($j=0;$j<$matrix22;$j++){
                            $result[$i][$j]=0;
                            for($k=0;$k<$matrix2;$k++){
                             $result[$i][$j]+=$matrixA[$i][$k]*$matrixB[$k][$j];
                            }
                          }
                        }
                      for($i=0;$i<$rows1;$i++){
                        for($j=0;$j<$matrix22;$j++){  
                          if($j<$matrix22 && ($j!==0)){
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
                        for ($i=0; $i <$rows1;$i++) { 
                            for($j=0;$j<$columns1;$j++){
                            if($j<$columns1 && ($j!==0)){
                                ?>
                                &
                                <?php
                            }
                            $first_matrix=$matrixA[$i][$j];
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
                            for ($i=0; $i <$matrix2;$i++) { 
                              for ($j=0; $j<$matrix22;$j++) { 
                                if($j<$matrix22 && ($j!==0)){
                                    ?>
                                    &
                                    <?php
                                  }
                              $second_matrix=$matrixB[$i][$j];
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
              for($i=0;$i<$rows1;$i++){
              for($j=0;$j<$matrix22;$j++){
                $result[$i][$j]=0;
                for($k=0;$k<$matrix2;$k++){
                  if ($k==0) {
                    echo "( ";
                  }
                  if ($k==$matrix2-1) {
                    echo $matrixA[$i][$k]."*".$matrixB[$k][$j]." ) ";
                  }else{
                    echo $matrixA[$i][$k]."*".$matrixB[$k][$j]."+";
                  }
                 $result[$i][$j]+=$matrixA[$i][$k]*$matrixB[$k][$j];
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
              for($i=0;$i<$rows1;$i++){
              for($j=0;$j<$matrix22;$j++){
                $result[$i][$j]=0;
                for($k=0;$k<$matrix2;$k++){
                  if($k==0){
                    echo"(";
                  }
                  if ($k==$matrix2-1) {
                    echo $matrixA[$i][$k]*$matrixB[$k][$j]." ) ";
                  }else{
                    echo $matrixA[$i][$k]*$matrixB[$k][$j]."+";
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
          for($i=0;$i<$rows1;$i++){
            for($j=0;$j<$matrix22;$j++){
               $result[$i][$j]=0;
              for($k=0;$k<$matrix2;$k++){
              $result[$i][$j]+=$matrixA[$i][$k]*$matrixB[$k][$j];
              $result[$i] [$j];
            }
          }
        }
            ?>
                \begin{bmatrix}
                <?php
                for($i=0;$i<$rows1;$i++){
                    for($j=0;$j<$matrix22;$j++){
                      if($j<$matrix22 &&  ($j!==0)){
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
