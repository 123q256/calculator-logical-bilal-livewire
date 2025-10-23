<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-3  gap-4">
            <div class="space-y-2">
                <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2">
                    <textarea name="x" id="textarea" class="textareaInput" aria-label="input"placeholder="e.g. 20, 30, 15
20 50 56 88">{{ isset($_POST['x']) ? $_POST['x'] : ''}}</textarea>
                </div>
            </div>
            <div class="space-y-2 hidden">
                <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                <div class="w-100 py-2">
                    <input type="text" name="seprate" id="seprate" value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" class="input readonly" readonly aria-label="input" placeholder=" " />
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
                            <div class="text-center">
                                <p class="font-s-20"><strong>{{ $lang['9'] }}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[32px] w-auto bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-blue">
                                        @php
                                            if (isset($detail['geo'])) {
                                                echo $detail['geo'];
                                            }else{
                                                echo round(pow(array_product($detail['numbers']), (1/$detail['count'])),4);
                                            }
                                        @endphp
                                    </strong>
                                </p>
                            </div>
                        </div>
                            @isset($detail['textline'])
                                <p>Note: The negative values are detected in the input. All values will be treated as percentages(e,g -20 will be treated as -20%).</p>
                            @endisset
                            <p class="w-full mt-2 font-s-18"><strong class="text-blue ">{{$lang['sol']}}:</strong></p>
                            <p class="w-full mt-2"><?=$lang['9']?> = <sup><?=$detail['count']?></sup>√<?=$detail['sol']?></p>
                            @if (isset($detail['geo']))
                                <p class="w-full mt-2"><?=$lang['9']?> = <sup><?=$detail['count']?></sup>√<?=$detail['sol1']?></p>
                                <p class="w-full mt-2"><?=$lang['9']?> = <sup><?=$detail['count']?></sup>√<?=$detail['pro']?></p>
                                <p class="w-full mt-2"><?=$lang['9']?> = <?=round(pow($detail['pro'], (1/$detail['count'])),4)?></p>
                                <p class="w-full mt-2"><?=$lang['9']?> = (<?=round(pow($detail['pro'], (1/$detail['count'])),4)?> - 1) x 100</p>
                                <p class="w-full mt-2"><?=$lang['9']?> = <?=$detail['geo']?></p>
                            @else
                                <p class="w-full mt-2"><?=$lang['9']?> = <sup><?=$detail['count']?></sup>√<?=array_product($detail['numbers'])?></p>
                                <p class="w-full mt-2"><?=$lang['9']?> = <?=round(pow(array_product($detail['numbers']), (1/$detail['count'])),4)?></p>
                            @endif
                            <div class="w-full mt-2">
                                <strong class="text-blue font-s-18">{{$lang['other_key']}}</strong>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="w-100">
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['10']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                foreach ($detail['numbers'] as $key => $value) {
                                                    if ($key==($detail['count']-1)) {
                                                        echo $value;
                                                    }else{
                                                        echo $value." , ";
                                                    }
                                                }
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['11']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                rsort($detail['numbers']);
                                                foreach ($detail['numbers'] as $key => $value) {
                                                    if ($key==($detail['count']-1)) {
                                                        echo $value;
                                                    }else{
                                                        echo $value." , ";
                                                    }
                                                }
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['12']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                foreach ($detail['numbers'] as $key => $value) {
                                                    if ($value % 2==0) {
                                                        echo $value." , ";
                                                    }
                                                }
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['13']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                foreach ($detail['numbers'] as $key => $value) {
                                                    if ($value % 2) {
                                                        echo $value." , ";
                                                    }
                                                }
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['14']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                echo array_sum($detail['numbers']);
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['15']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                echo max($detail['numbers']);
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['16']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                echo min($detail['numbers']);
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang['17']?>:</td>
                                        <td class="py-2 border-b">
                                            <?php 
                                                echo count($detail['numbers']);
                                             ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>