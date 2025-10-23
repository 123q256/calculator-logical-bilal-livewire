<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 relative">
                            <label for="flips" class="font-s-14 text-blue">{{ $lang['1'] }} (n):</label>
                            <input type="number" step="any" name="flips" id="flips" value="{{ isset($_POST['flips'])?$_POST['flips']:'6' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                        <div class="space-y-2">
                            <label for="heads" class="font-s-14 text-blue">{{ $lang['2'] }} (X):</label>
                            <input type="number" step="any" name="heads" id="heads" value="{{ isset($_POST['heads'])?$_POST['heads']:'2' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                        <div class="space-y-2">
                            <label for="probablity" class="font-s-14 text-blue">{{ $lang['3'] }} (p):</label>
                            <input type="number" step="any" name="probablity" id="probablity" value="{{ isset($_POST['probablity'])?$_POST['probablity']:'0.5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                        <div class="space-y-2">
                            <label for="type" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <select name="type" id="type" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name=[$lang['5']." X ".$lang['6'],$lang['7']." X ".$lang['6'],$lang['8']." X ".$lang['6']];
                                    $val = ["1","2","3"];
                                    optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'1');
                                @endphp
                            </select>
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
     
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculatorrounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full">
                        @php
                            if (isset($detail['array_awa'])) {
                                $array_awa = $detail['array_awa'];
                                $read = count($array_awa) - 1;
                            }
                        @endphp
                        @if ($detail['type']=="1")    
                            <div class="col-lg-7 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b">P(<?php echo $detail['heads'] ?>) <?=$lang['9']?> <?php echo $detail['heads']; ?> <?=$lang['6']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= $detail['ans'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">P(<?php echo $detail['heads'] ?>) <?=$lang['9']?> <?php echo $detail['heads']; ?> <?=$lang['20']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= 1-$detail['ans'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['11']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= $detail['ans']*100 ?>%</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @elseif($detail['type']=="2")
                            <div class="col-lg-7 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b">P(X≥<?php echo $detail['heads'] ?>) <?=$lang['10']?><?php echo $detail['heads']; ?> <?=$lang['6']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= round($detail['summer']+$detail['ans'],2) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">P(X≥<?php echo $detail['heads'] ?>) <?=$lang['10']?><?php echo $detail['heads']; ?> <?=$lang['20']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= 1-round($detail['summer']+$detail['ans'],2) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['11']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= round(($detail['summer']+$detail['ans'])*100) ?>%</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @elseif($detail['type']=="3")
                            <div class="col-lg-7 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b">P(X≤<?php echo $detail['heads'] ?>) <?=$lang['12']?> <?php echo $detail['heads']; ?> <?=$lang['6']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= $detail['summer'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">P(X≤<?php echo $detail['heads'] ?>) <?=$lang['12']?> <?php echo $detail['heads']; ?> <?=$lang['20']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= 1-$detail['summer'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['11']?></td>
                                        <td class="py-2 border-b"><strong class="text-blue"><?= $detail['summer']*100 ?>%</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        <p class="col-12 mt-3 font-s-20"><?=$lang['13']?>:</p>
                        <p class="col-12 mt-2"><?=$lang['14']?>:</p>
                        @if ($detail['type']=="1" || $detail['type']=="2")
                            <p class="col-12 mt-2">$$P(X)=\dfrac{n!}{X!(n-X!)}.p^X.(1-p)^{n-X}$$</p>
                            <?php if ($detail['type'] == "2") { ?>
                                <p class="col-12 mt-2"><?= $lang['15'] ?> P(<?php echo $detail['heads']; ?>)</p>
                            <?php  } ?>
                            <p class="col-12 mt-2"><?= $lang['16'] ?> : n=<?php echo $detail['flips'] ?> , X=<?php echo $detail['heads']; ?> , p=<?php echo $detail['probablity']; ?> <?php echo $lang['21'] ?></p>
                            <p class="col-12 mt-2">\(P(<?php echo $detail['heads'] ?>)=\dfrac{<?php echo $detail['flips'] ?>!}{<?php echo $detail['heads'] ?>!(<?php echo $detail['flips'] ?>-<?php echo $detail['heads'] ?>!)} . (<?php echo $detail['probablity'] ?>)^{<?php echo $detail['heads'] ?>} . (1-<?php echo $detail['probablity'] ?>)^{<?php echo $detail['flips'] ?>-<?php echo $detail['heads'] ?>}\)</p>
                            <p class="col-12 mt-2"><?= $lang['17'] ?></p>
                            <p class="col-12 mt-3">$$P(<?php echo $detail['heads'] ?>)=<?php echo $detail['ans']; ?>$$</p>
                            <?php if ($detail['type'] == "2") { ?>
                                <p class="col-12 mt-3 font-s-20 text-blue"><?= $lang['18'] ?>:</p>
                                <p class="col-12 mt-2"><?= $lang['19'] ?>:</p>
                                <p class="col-12 mt-2">P(X≥<?php echo $detail['heads'] ?>)=
                                    <?php
                                    for ($i = $detail['heads']; $i <= $detail['flips']; $i++) { ?>
                                        P(<?php echo $i ?>)
                                        <?php
                                        if ($detail['flips'] == $i) { ?>
                                        <?php } else { ?>
                                            +
                                        <?php  }
                                        ?>
                                    <?php }
                                    ?>
                                </p>
                                <p class="col-12 mt-2">
                                    P(X≥<?php echo $detail['heads'] ?>)=
                                    <?php
                                    echo $detail['ans'] . " + ";
                                    foreach ($array_awa as $key => $value) {
                                        echo $value;
                                        if ($key == $read) {
                                            echo "";
                                        } else {
                                            echo " + ";
                                        }
                                    }
                                    ?><br>
                                </p>
                                <p class="col-12 mt-2 dk">
                                    <span class="text-blue font-s-20">P(X≥<?php echo $detail['heads'] ?>)=<?php echo round($detail['summer'] + $detail['ans'], 5); ?></span>
                                </p>
                            <?php } ?>
                        @else
                            <p class="col-12 mt-2">$$P(X)=\dfrac{n!}{X!(n-X!)}.p^X.(1-p)^{n-X}$$</p>
                            <p class="col-12 mt-2"><?= $lang['15'] ?> P (0)</p>
                            <p class="col-12 mt-2"><?= $lang['16'] ?>: n=<?php echo $detail['flips'] ?> , X=0 , p=<?php echo $detail['probablity']; ?> <?php echo $lang['21'] ?></p>
                            <p class="col-12 mt-2">$$P(0)=\dfrac{<?php echo $detail['flips'] ?>!}{0!(<?php echo $detail['flips'] ?>-0!)} . (<?php echo $detail['probablity'] ?>)^{0} . (1-<?php echo $detail['probablity'] ?>)^{<?php echo $detail['flips'] ?>-0}$$</p>
                            <p class="col-12 mt-2"><?= $lang['17'] ?></p>
                            <p class="col-12 mt-2">$$P(0)=<?php echo $detail['ans']; ?>$$</p>
                            <p class="col-12 mt-3 font-s-20 text-blue"><?= $lang['18'] ?>:</p>
                            <p class="col-12 mt-2"><?= $lang['19'] ?>:</p>
                            <p class="col-12 mt-2">P(X≤<?php echo $detail['heads'] ?>)=
                                <?php
                                for ($i = 0; $i <= $detail['heads']; $i++) { ?>
                                    P(<?php echo $i ?>)
                                    <?php
                                    if ($detail['heads'] == $i) { ?>
                                    <?php } else { ?>
                                        +
                                    <?php  }
                                    ?>
                                <?php }
                                ?>
                            </p>
                            <p class="col-12 mt-2">
                                P(X≥<?php echo $detail['heads'] ?>)=
                                <?php
            
                                ?>
                                <?php
                                foreach ($array_awa as $key => $value) {
                                    echo $value;
                                    if ($key == $read) {
                                        echo "";
                                    } else {
                                        echo " + ";
                                    }
                                }
                                ?><br>
                            </p>
                            <p class="col-12 mt-2">P(X≥<?php echo $detail['heads'] ?>)=<?php echo round($detail['summer'], 5); ?></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script>
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>