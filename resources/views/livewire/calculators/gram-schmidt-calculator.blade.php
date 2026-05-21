<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-3">
                <select wire:model.live="matrix2" class="input input1" id="rows2" aria-label="select">
                    @for($i = 1; $i <= 10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-1 text-[16px]"><strong>X</strong></p>
            <div class="col-span-3">
                <select wire:model.live="matrix22" class="input input2" id="columns2" aria-label="select">
                    @for($i = 1; $i <= 10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <p class="col-span-12 text-[16px]"><strong><?=$lang[3]?></strong></p>
            <div class="col-span-12 overflow-auto">
                <table id="matrix2">
                    @for ($i = 1; $i <= $matrix2; $i++)
                        <tr>
                            @for ($j = 1; $j <= $matrix22; $j++)
                                <td>
                                    <div class="px-1 pt-2">
                                        <input type="number" step="any" wire:model.live="matrix3.{{$i}}.{{$j}}" class="input" required>
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
                            <div class="w-full text-[16px]">
                                <p class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 text-[18px] ">
                                    \(
                                    \begin{bmatrix}
                                      <?php
                                      foreach ($detail['first_unit'] as  $value4) {
                                        echo $value4;
                                        ?>
                                        \\
                                        <?php
                                      }
                                      ?>
                                    \end{bmatrix}
                                    <?php
                                    foreach ($detail['all_vecunit'] as $values) {
                                      ?>
                                      \begin{bmatrix}
                                      <?php
                                      foreach ($values as  $values2) {
                                        echo $values2;
                                        ?>
                                        \\
                                        <?php
                                      } 
                                      ?>
                                      \end{bmatrix}
                                      <?php 
                                    }
                                    ?>
                                    \)
                                </p>
                                <p class="mt-2 text-[18px]"><strong><?=$lang[5]?></strong></p> 
                                <p class="mt-2 ">
                                    <?=$lang[6]?>
                                    \(
                                        <?php
                                        $k=1;
                                        foreach ($detail['all_vec'] as $value3) {
                                            echo "V_".$k." =";
                                            $k++;
                                            ?>
                                            \begin{bmatrix}
                                            <?php
                                            foreach ($value3 as  $value4) {
                                            echo $value4;
                                            ?>
                                            <?php
                                            } 
                                            ?>
                                            \end{bmatrix} ,
                                            <?php 
                                        }
                                        ?>
                                    \)
                                    <?=$lang[7]?>.
                                </p>
                                <p class="mt-2 text-[18px]"><strong>Step by Step <?=$lang[8]?>:</strong></p>
                                <div class="bg-[#F6FAFC] border radius-10 px-3 py-2 mt-2 ">
                                    <p class="mt-2 overflow-auto">
                                        {{-- \(
                                        \text{<?=$lang[9]?>,} \ \vec{u_k} = \vec{v_k} - \Sigma_{j-1}^\text{k-1} \ proj_\vec{uj} \ (\vec{v_k}) \ \text{<?=$lang[10]?>} \ proj_\vec{uj} \  (\vec{v_k}) = \frac{ \vec{u_j} \cdot \vec{v_k}}{|{\vec{u_j}}|^2} \vec{u_j} \ \text{​<?=$lang[11]?> .}
                                        \) --}}
                                        \(
                                        \text{<?=$lang[9]?>,} \ \vec{u_k} = \vec{v_k} - \sum_{j=1}^{k-1} \text{proj}_{\vec{u_j}}(\vec{v_k}) \quad \text{<?=$lang[10]?>} \quad \text{proj}_{\vec{u_j}}(\vec{v_k}) = \frac{\vec{u_j} \cdot \vec{v_k}}{|\vec{u_j}|^2} \vec{u_j} \quad \text{<?=$lang[11]?>.}
                                        \)
                
                                    </p>
                                    <p class="mt-2">
                                        \(
                                        \text{<?=$lang[12]?>} \ \vec{e_k} = \frac{ \vec{u_k}}{|{\vec{u_k}}|}
                                        \)
                                    </p>
                                    <p class="mt-2 font-s-18"><strong><?=$lang[13]?> 1</strong></p>
                                    <p class="mt-2">
                                        \(
                                        \vec{u_1} \ = \ \vec{v_1} \ = \ \begin{bmatrix}
                                        <?php
                                        foreach ($detail['all_vec'][0] as  $value4) {
                                            echo $value4;
                                            ?>
                                            \\
                                            <?php
                                        }
                                        ?>
                                        \end{bmatrix}
                                        \)
                                    </p>
                                    <p class="mt-2"><?=$lang[14]?> <a href="{{ url('unit-vector-calculator') }}/" class="text-blue-500 underline" target="_blank">Unit Vector Calculator</a>) </p>
                                    <p class="mt-2">
                                        \(
                                        \vec{u_1} \ = \ \vec{v_1} \ = \ \begin{bmatrix}
                                        <?php
                                        foreach ($detail['first_unit'] as  $value4) {
                                            echo $value4;
                                            ?>
                                            \\
                                            <?php
                                        }
                                        ?>
                                        \end{bmatrix} \)
                                    </p>
                                    <p class="mt-2">
                                        <?php
                                        for ($n=0; $n < count($detail['pros_ans']); $n++) {
                                        echo "<p class='mt-2 font-s-18 fw-bold'>".$lang[13]." ".($n+2)."</p>";
                                        ?>
                                        <p class='mt-2'>
                                            <?=$lang[15]?> <a href="{{ url('vector-projection-calculator') }}/" class="text-blue-500 underline" target="_blank">Vector Projection Calculator</a>)
                                            \(
                                                \text{proj}_{\vec{u_1}}(\vec{v_{<?= ($n+2) ?>}}) 
                                                <?php if ($n != 0) { ?>
                                                - \text{proj}_{\vec{u_2}}(\vec{v_{<?= ($n+2) ?>}})
                                                <?php } ?> =
                                                \begin{bmatrix}
                                                <?php
                                                foreach ($detail['pros_ans'][$n] as $value4) {
                                                    echo round($value4, 2) . " \\\\ ";
                                                }
                                                ?>
                                                \end{bmatrix} \\
                                                \)
                
                                        </p>
                                        <p class="mt-2">
                                            <?=$lang[16]?>:
                                        </p>
                                        <p class="mt-2">
                                            \(
                                                \vec{u_{<?=($n+2)?>}} = \vec{v_{<?=($n+2)?>}} - \text{proj}_{\vec{u_1}}(\vec{v_{<?=($n+2)?>}}) 
                                                <?php if ($n != 0) { ?>
                                                - \text{proj}_{\vec{u_2}}(\vec{v_{<?=($n+2)?>}})
                                                <?php } ?> = 
                                                \begin{bmatrix}
                                                <?php
                                                foreach ($detail['subtract'][$n] as $value3) {
                                                    echo round($value3, 2) . " \\\\ ";
                                                }
                                                ?>
                                                \end{bmatrix}
                                                \)
                
                                        </p>
                                        <p class="mt-2">
                                            <?=$lang[14]?>
                                        </p>
                                        <p class="mt-2">
                                            \( 
                                            \vec{e_<?= ($n+2) ?>} = \frac{ \vec{u_<?= ($n+2) ?>}}{|{\vec{u_<?= ($n+2) ?>}}|} \ = \
                                            \begin{bmatrix}
                                            <?php
                                            foreach ($detail['all_vecunit'][$n] as  $value3) {
                                                echo round($value3, 2);
                                                ?>
                                                \\
                                                <?php
                                            } 
                                            ?>
                                            \end{bmatrix}
                                            \)
                                        </p>
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
        </div>
    
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</form>

</div>
