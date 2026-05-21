<div>
  <style>
    img{
        object-fit: contain;
    }
</style>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="method" class="label"><?=$lang['1'] ?></label>
                <div class="w-100 py-2">
                    <select wire:model.live="method" class="input" id="method" aria-label="select">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2">{{$lang['3']}}</option>
                        <option value="3">{{$lang['4']}}</option>
                        <option value="4">{{$lang['5']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="row" class="label"><?=$lang['6']?> (n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="row" id="row" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 to_row {{ $method=='3'?'':'hidden' }}">
                <label for="to_row" class="label"><?=$lang['7']?></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="to_row" id="to_row" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 column {{ $method=='4'?'':'hidden' }}">
                <label for="column" class="label"><?=$lang['8']?> (k)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="column" id="column" class="input" aria-label="input" />
                </div>
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
                            $rows=$detail['row'];
                            $read=$detail['row'];
                            $method=$detail['method'];
                        @endphp
                        @if($method === "1")
                            <div class="w-full overflow-auto">
                                <table class="w-full text-[18px]">
                                    <?php
                                    $level =$rows+1;
                                    for ($y = 1; $y <= $level; $y ++){
                                      echo "<tr>";
                                      $l2=$y-1;
                                      echo"<td class='py-2 border-b'><b>".$l2.".</b></td>";
                                      echo"<td class='py-2 border-b'></td>";
                                      for ($x = 1; $x <= $y; $x ++){
                                        if($x == 1){
                                          $number[$y][$x] = 1;
                                          if($level != $y){
                                            echo "<td class='py-2 border-b' colspan='".($level-$y)."'></td>";
                                          }
                                          echo "<td class='year py-2 border-b'>".$number[$y][$x]."</td>";
                                          echo "<td class='py-2 border-b'></td>";
                                        }elseif($x == $y){
                                          $number[$y][$x] = 1; 
                                          echo "<td class='year py-2 border-b'>".$number[$y][$x]."</td>";
                                        }else{
                                          $number[$y][$x] = $number[$y-1][$x-1] + $number[$y-1][$x];
                                          echo "<td class='year py-2 border-b'>".$number[$y][$x]."</td>";
                                          echo "<td class='py-2 border-b'></td>";
                                        }
                                      }
                                      echo "</tr>";
                                    }
                                    ?>
                                    </table>
                            </div>
                        @elseif($method === "2")
                            @php
                                $n = $detail['row'];
                                $arr = [1];
                                if ($n > 0) {
                                    for ($i = 1; $i <= $n; $i++) {
                                        $arr[$i] = $arr[$i - 1] * ($n - $i + 1) / $i;
                                    }
                                }
                            @endphp
                            <div class="w-full text-center my-2">
                                <p><strong class="bg-white px-3 py-2 font-s-21 radius-10 text-blue showing">
                                    <b>{{ $n }}</b>. 
                                    @foreach($arr as $val)
                                        {{ $val }}  
                                    @endforeach
                                </strong></p>
                            </div>
                        @elseif($method === "3")
                            <div class="w-full">
                                <table class="w-full font-s-18">
                                    <?php
                                        $cols=$detail['col'];
                                        for ($i=$rows; $i <=$cols; $i++) {
                                        echo"<tr>"; 
                                        $num=1;
                                        echo"<td class='py-2 border-b'><b>".$i.".</td></b>";
                                        for($k=$cols;$k>$i;$k--){
                                            echo"<td class='py-2 border-b'></td>";
                                        }
                                        for($j=0;$j<=$i;$j++){
                                            echo "<td class='py-2 border-b'>".$num."</td>";
                                            if($j<$i){
                                            echo"<td class='py-2 border-b'></td>";
                                            }
                                            $num=$num*($i-$j)/($j+1);
                                        }
                                        echo"</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        @else
                            @php
                                function pascal_triangle($c, $r)
                                {
                                    if ($c == 0 || $c == $r) {
                                        return 1;
                                    } else {
                                        return pascal_triangle($c-1, $r-1) + pascal_triangle($c, $r - 1);
                                    }
                                }
                                $resulting=pascal_triangle($detail['column'],$rows);
                            @endphp
                            <div class="w-full text-center my-2">
                                <p><strong class="bg-white px-3 py-2 font-s-21 radius-10 text-blue"><?php echo $resulting; ?></strong></p>
                            </div>
                        @endif
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
           function MJrerender() {
               if (typeof renderMathInElement === 'function') {
                   renderMathInElement(document.body);
               }
           }
           document.addEventListener('livewire:initialized', () => {
               Livewire.hook('morph.updated', () => {
                   MJrerender();
               });
           });
       </script>

    @endpush
</form>
</div>
