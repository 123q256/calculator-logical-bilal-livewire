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
            <p class="col-span-12"><strong><?=$lang[1]?>:</strong></p>
            <div class="col-span-2">
                <select wire:model.live="row" name="row" class="input" id="row" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-1 flex items-center"><strong>X</strong></p>
            <div class="col-span-2">
                <select wire:model.live="colum" name="colum" class="input" id="colum" aria-label="select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-span-12">
                <table class="matrix_table w-100">
                    @for ($i = 0; $i < $row; $i++)
                        <tr>
                            @for ($j = 0; $j < $colum; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        @php $mat = 'matrix.'.$i.'.'.$j; @endphp
                                        <input type="number" step="any" wire:model.defer="{{ $mat }}" name="matrix_{{$i}}_{{$j}}" class="input" required>
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
            <div class="col-span-12">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['2']?></button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['3']?></button>
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
    
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><?=$lang['4']?>:</p>
                            <p class="mt-3">\(<?=$detail['enter']?>\)</p>
                            <p class="mt-3"><?=$lang['5']?>:</p>
                            <p class="mt-3">\(<?=$detail['rref']?>\)</p>
                            <p class="mt-3"><?=$lang['6']?>:</p>
                            <?php 
                                $colum='\left[\begin{matrix}';
                                for ($i=1; $i <= $detail['colum']; $i++) { 
                                if ($i!=$detail['colum']) {
                                    $colum.="x_".$i.'\\\\';
                                }else{
                                    $colum.="x_{".$i.'}';
                                }
                                }
                                $row='\left[\begin{matrix}';
                                for ($i=1; $i <= $detail['row']; $i++) { 
                                if ($i!=$detail['row']) {
                                    $row.="0".'\\\\';
                                }else{
                                    $row.="0";
                                }
                                }
                            ?>
                            <p class="mt-3">\( <?=$detail['rref']?><?=$colum?>\end{matrix}\right] = <?=$row?>\end{matrix}\right]\)</p>
                            <p class="mt-3"><?=$lang['7']?>:</p>
                            <?php if($detail['total']==0){ ?>
                                <?php 
                                $row='\left[\begin{matrix}';
                                for ($i=1; $i <= $detail['row']; $i++) { 
                                    if ($i!=$detail['row']) {
                                    $row.="0".'\\\\';
                                    }else{
                                    $row.="0";
                                    }
                                }
                                ?>
                                <p class="mt-3 font-s-18">\(<?=$row?>\end{matrix}\right]\)</p>
                            <?php }else{ ?>
                                <p class="mt-3 font-s-18">\(<?=$detail['null']?>\)</p>
                            <?php } ?>
                            <p class="mt-3"><?=$lang['8']?>: <?=$detail['total']?></p>
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
