<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="col-span-6 px-2">
                    <label for="method" class="label">{{ $lang['1'] }} (m):</label>
                    <div class="w-100 py-2">
                        <select name="method" id="method" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4']];
                                $val = ['0','1','2'];
                                optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 px-2 d-flex align-items-center justify-content-center">
                    <label for="method" class="label">&nbsp;</label>
                    <img src="{{url('images/mad_formula.webp')}}" width="165" height="50" loading="lazy" alt="MAD Formula">
                </div>
                <div class="col-span-6 px-2 point hidden">
                    <label for="m" class="label">{{ $lang['5'] }} (m)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="m" id="m" value="{{ isset($_POST['m'])?$_POST['m']:'10' }}" class="input " aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="textarea" class="label">{{ $lang['6'] }} ( , )</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'5, 5, 5, 6, 7, 7, 7, 9, 9, 10' }}</textarea>
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
                        <div class="w-full">
                            @php
                                $mad=$detail['mad'];
                                $m=$detail['m'];
                                $x=$detail['x'];
                                $data=array_map('trim',array_filter(explode(',',$x)));
                                $n=count($data);
                            @endphp
                            <div class="text-center">
                                <p class="text-[20px]">
                                    <strong>
                                        @php
                                            if($detail['method']==0){
                                                echo $lang['7'];
                                            }elseif($detail['method']==1){
                                                echo $lang['8'];
                                            }else{
                                                echo $lang['9'];
                                            }
                                        @endphp
                                    </strong>
                                </p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-blue">{{ $detail['mad'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="col s12 font_size28"><?=$lang['10']?></p>
                            <?php if(isset($detail['mean'])){ ?>
                                @php
                                    $mean=$detail['mean'];
                                    $diff=$detail['diff'];
                                    $diff_sum=$detail['sum1'];
                                @endphp
                                <p class="w-full mt-2 font-s-18"><span class="text-blue"><?=$lang['11']?> 1: </span><b><?=$lang['12']?>:</b></p>
                                <p class="w-full mt-1">
                                    <?php
                                        echo "(";
                                        for($i=0; $i < $n; $i++){
                                            $plus=' + ';
                                            if($i+1==$n){
                                                $plus='';
                                            }
                                            echo "$data[$i]$plus";
                                        }
                                        echo ")/$n = $mean";
                                    ?>
                                </p>
                                <p class="w-full mt-3 font-s-18"><span class="text-blue"><?=$lang['11']?> 2: </span><b><?=$lang['13']?>:</b></p>
                                <p class="w-full mt-1 1">
                                    <?php
                                    for($i=0; $i < $n; $i++){
                                        echo $lang['14']." $data[$i] and $mean is $diff[$i]<br>";
                                    }
                                    ?>
                                </p>
                                <p class="w-full mt-3 font-s-18"> <span class="text-blue"><?=$lang['11']?> 3: </span><b><?=$lang['15']?>:</b></p>
                                <p class="w-full mt-1">
                                    <?php
                                    for($i=0; $i < $n; $i++){
                                        $plus=' + ';
                                        if($i+1==$n){
                                            $plus='';
                                        }
                                        echo "$diff[$i]$plus";
                                    }
                                        echo " = $diff_sum";
                                    ?>
                                </p>
                                <p class="w-full mt-3 font-s-18"> <span class="text-blue"><?=$lang['11']?> 4: </span><b><?=$lang['16']?>:</b></p>
                                <p class="w-full mt-1"><?="$diff_sum/$n = ".round(($diff_sum/$n),1)."<br>".$lang['17']." <b>".$lang['9']."</b> = $mad</span>"?></p>
                            <?php }elseif(isset($detail['median'])){ ?>
                                @php
                                    $median=$detail['median'];
                                    $diff1=$detail['diff1'];
                                    $diff=$detail['diff'];
                                @endphp
                                <p class="w-full mt-2 font-s-18"><span class="text-blue"><?=$lang['11']?> 1: </span><b><?=$lang['18']?>:</b></p>
                                <p class="w-full mt-2 font-s-18 ms-3"><span class="text-blue"><?=$lang['11']?> 1: </span><b><?=$lang['19']?>:</b></p>
                                <p class="w-full mt-1 ms-3">
                                    <?php
                                        echo "<span ><b>".$lang['20'].":</b> ";
                                        for($i=0; $i < $n; $i++){
                                            $comma=',';
                                            if($i+1==$n){
                                                $comma='';
                                            }
                                            echo "$data[$i]$comma";
                                        }
                                        echo "</span><br><span ><b>".$lang['21'].":</b> &nbsp;&nbsp;";
                                        for($i=0; $i < $n; $i++){
                                            $comma=',';
                                            if($i+1==$n){
                                                $comma='';
                                            }
                                            sort($data);
                                            echo "$data[$i]$comma";
                                        }
                                        echo "</span>";
                                    ?>
                                </p>
                                <p class="w-full mt-2 font-s-18 ms-3"><span class="text-blue"><?=$lang['11']?> 2: </span><b><?=$lang['22']?>:</b></p>
                                <p class="w-full mt-1 ms-3">
                                    <span >
                                    <?php
                                    $center=$n/2;
                                    echo $lang['23']." 2<br><span >";
                                    echo "$n/2 = ".$center." => ".round($center)."</span>";
                                    ?>
                                    </span>
                                </p>
                                <p class="w-full mt-2 font-s-18 ms-3"><span class="text-blue"><?=$lang['11']?> 3: </span><b><?=$lang['24']?>:</b></p>
                                <p class="w-full mt-1 ms-3"><span><?=$lang['17']." <b>".$lang['3']."</b> = $median</span>"?></span></p>
                                <p class="w-full mt-3 font-s-18"><span class="text-blue"><?=$lang['11']?> 2: </span><b><?=$lang['13']?>:</b></p>
                                <p class="w-full mt-1 1">
                                    <?php
                                    for($i=0; $i < $n; $i++){
                                        echo $lang['14']." $data[$i] and $median is $diff[$i]<br>";
                                    }
                                    ?>
                                </p>
                                <p class="w-full mt-3 font-s-18"> <span class="text-blue"><?=$lang['11']?> 3: </span><b><?=$lang['25']?>:</b></p>
                                <p class="w-full mt-2 font-s-18 ms-3"><span class="text-blue"><?=$lang['11']?> 1: </span><b><?=$lang['19']?>:</b></p>
                                <p class="w-full mt-1 ms-3">
                                    <?php
                                        echo "<span ><b>".$lang['20'].":</b> ";
                                        for($i=0; $i < $n; $i++){
                                            $comma=',';
                                            if($i+1==$n){
                                                $comma='';
                                            }
                                            echo "$diff[$i]$comma";
                                        }
                                        echo "</span><br><span ><b>".$lang['21'].":</b> &nbsp;&nbsp;";
                                        for($i=0; $i < $n; $i++){
                                            $comma=',';
                                            if($i+1==$n){
                                                $comma='';
                                            }
                                            sort($data);
                                            echo "$diff1[$i]$comma";
                                        }
                                        echo "</span>";
                                    ?>
                                </p>
                                <p class="w-full mt-2 font-s-18 ms-3"><span class="text-blue"><?=$lang['11']?> 2: </span><b><?=$lang['22']?>:</b></p>
                                <p class="w-full mt-1 ms-3">
                                    <span >
                                    <?php
                                    $center=$n/2;
                                    echo $lang['23']." 2<br><span >";
                                    echo "$n/2 = ".$center." => ".round($center)."</span>";
                                    ?>
                                    </span>
                                </p>
                                <p class="w-full mt-3 font-s-18"> <span class="text-blue"><?=$lang['11']?> 4: </span><b><?=$lang['24']?>:</b></p>
                                <p class="w-full mt-1"><?="So, the <b>MAD</b> = $mad</span>"?></p>
                            <?php }else{ ?>
                                @php
                                    $diff_sum1=isset($detail['sum'])?$detail['sum']:0;
                                    $diff=isset($detail['diff'])?$detail['diff']:0;
                                @endphp
                                <p class="w-full mt-3 font-s-18"><span class="text-blue"><?=$lang['11']?> 1: </span><b><?=$lang['26']?> (m):</b></p>
                                <p class="w-full mt-1">
                                    <?php
                                    for($i=0; $i < $n; $i++){
                                        echo $lang['14']." $data[$i] and $m is $diff[$i]<br>";
                                    }
                                    ?>
                                </p>
                                <p class="w-full mt-3 font-s-18"> <span class="text-blue"><?=$lang['11']?> 2: </span><b><?=$lang['15']?>:</b></p>
                                <p class="w-full mt-1">
                                    <?php
                                    for($i=0; $i < $n; $i++){
                                        $plus='+';
                                        if($i+1==$n){
                                            $plus='';
                                        }
                                        echo "$diff[$i]$plus";
                                    }
                                    echo " = $diff_sum1";
                                    ?>
                                </p>
                                <p class="w-full mt-3 font-s-18"> <span class="text-blue"><?=$lang['11']?> 3: </span><b><?=$lang['16']?>:</b></p>
                                <p class="w-full mt-1"><?="$diff_sum1/$n = ".round(($diff_sum1/$n),1)."<br>".$lang['17']." <b>".$lang['9']."</b> = $mad</span>"?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        let val = document.getElementById('method').value;
        if (val == 0) {
            document.querySelectorAll('.point').forEach(function(point) {
                point.style.display = 'none';
            });
        } else if (val == 1) {
            document.querySelectorAll('.point').forEach(function(point) {
                point.style.display = 'none';
            });
        } else if (val == 2) {
            document.querySelectorAll('.point').forEach(function(point) {
                point.style.display = 'block';
            });
        }

        document.getElementById('method').addEventListener('change', function() {
            let val = document.getElementById('method').value;
            if (val == 0) {
                document.querySelectorAll('.point').forEach(function(point) {
                    point.style.display = 'none';
                });
            } else if (val == 1) {
                document.querySelectorAll('.point').forEach(function(point) {
                    point.style.display = 'none';
                });
            } else if (val == 2) {
                document.querySelectorAll('.point').forEach(function(point) {
                    point.style.display = 'block';
                });
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>