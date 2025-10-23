<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php 
                $request = request();
            @endphp
            <div class="col-span-12">
                <label for="method" class="label"><?=$lang['1'] ?></label>
                <div class="w-100 py-2">
                    <select name="method" class="input" id="method" aria-label="select">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($request->method) && $request->method=='2'?'selected':'' }}>{{$lang['3']}}</option>
                        <option value="3" {{ isset($request->method) && $request->method=='3'?'selected':'' }}>{{$lang['4']}}</option>
                        <option value="4" {{ isset($request->method) && $request->method=='4'?'selected':'' }}>{{$lang['5']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="row" class="label"><?=$lang['6']?> (n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="row" id="row" class="input" aria-label="input" value="{{ isset($request->row)?$request->row:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 to_row {{ isset($request->method) && $request->method=='3'?'':'hidden' }}">
                <label for="to_row" class="label"><?=$lang['7']?></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="to_row" id="to_row" class="input" aria-label="input" value="{{ isset($request->to_row)?$request->to_row:'10' }}" />
                </div>
            </div>
            <div class="col-span-12 column {{ isset($request->method) && $request->method=='4'?'':'hidden' }}">
                <label for="column" class="label"><?=$lang['8']?> (k)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="column" id="column" class="input" aria-label="input" value="{{ isset($request->column)?$request->column:'5' }}" />
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
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
                            <div class="w-full">
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
                            <div class="w-full text-center my-2">
                                <p><strong class="bg-white px-3 py-2 font-s-21 radius-10 text-blue showing"></strong></p>
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
            document.getElementById('method').addEventListener('change', function() {
                var methodValue = this.value;
                if(methodValue === "1"){
                    ['.to_row', '.column'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(methodValue === "2"){
                    ['.to_row', '.column'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(methodValue === "3"){
                    ['.to_row'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.column'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(methodValue === "4"){
                    ['.to_row'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.column'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
        @isset($detail)
            @if($request->method === "2")
                <script>
                    var rows="{{$detail['row']}}";
                    function getRow(rowIndex) {
                        let currow = [];
                        currow.push(1);
                        if (rowIndex == 0) {
                            return currow;
                        }
                        // Generate the previous row
                        let prev = getRow(rowIndex - 1);

                        for (let i = 1; i < prev.length; i++) {
                            let curr = prev[i - 1] + prev[i];
                            currow.push(curr);
                        }
                        currow.push(1);
                        return currow;
                    }
                    let n = rows;
                    let arr = getRow(n);

                    let showingElement = document.querySelector(".showing");
                    showingElement.insertAdjacentHTML('beforeend', "<b>" + n + "</b>. ");
                    for (let i = 0; i < arr.length; i++) {
                        if (i == arr.length - 1) {
                            showingElement.insertAdjacentHTML('beforeend', arr[i] + "  ");
                        } else {
                            showingElement.insertAdjacentHTML('beforeend', arr[i] + "  ");
                        }
                    }
                    showingElement.insertAdjacentHTML('beforeend', " ");

                </script> 
            @endif
        @endisset
    @endpush
</form>