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
            <p class="col-span-12 text-[16px] "><strong><?=$lang[1]?>:</strong></p>
            <div class="col-span-4">
                <input type="number" min="1" max="10" wire:model.live="matrix22" id="columns2" class="input" required>
            </div>
            <p class="col-span-12 text-[16px] "><strong><?=$lang[2]?></strong></p>
            <div class="col-span-12 overflow-x-auto">
                <table class="w-full" id="matrix2">
                    @for ($i = 1; $i <= $matrix22; $i++)
                        <tr>
                            @for ($j = 1; $j <= $matrix22; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        <input type="number" step="any" wire:model.defer="matrix.{{ $i }}.{{ $j }}" class="input" required>
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
                                $matrix22= $request->matrix22;
                            @endphp
                        <div class="w-full">
                            <div class="w-full text-[16px] overflow-auto">
                                <p class="mt-3 text-[18px]"><strong>\( <?=$detail['answer']?> \)</strong></p>
                                <p class="mt-3"><strong><?=$lang[5]?>:</strong></p>
                                <p class="mt-3">
                                    \( \begin{bmatrix}<?php
                                    foreach ($detail['input_ma'] as $value) {
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
                                  <p class="mt-3"><?=$lang[6]?></p>
                                  <p class="mt-3">
                                    \( \begin{bmatrix}<?php
                                    foreach ($detail['matrix'] as $value) {
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
                                  <p class="mt-3"><?=$lang[7]?> <a href="https://calculator-online.net/determinant-calculator/" class="text-blue" target="_blank">Determinant Calculator</a>)</p>
                                  <p class="mt-3">\( <?=$detail['answer']?> \)</p>
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
    @endpush
</form>

</div>
