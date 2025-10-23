<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['no'] }}:</label>
                    <select name="seprateby" id="seprateby" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['Space'],$lang['comma'],$lang['user']];
                            $val = ['space',',','user'];
                            optionsList($val,$name,isset($_POST['seprateby'])?$_POST['seprateby']:'space');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="text" name="seprate" readonly id="seprate" value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" class="input readonly" aria-label="input" placeholder=" " />
                </div>

            </div>
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
                    <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 55 62 35 32 50 57 54">{{ isset($_POST['x'])?$_POST['x']:'55 62 35 32 50 57 54' }}</textarea>
                </div>
            </div>
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <input type="number" step="any" name="p" id="p" value="{{ isset($_POST['p'])?$_POST['p']:'16' }}" min="0" max="100" class="input" aria-label="input" placeholder=" " />
                    <span class="text-blue input_unit">%</span>
                </div>
                <div class="space-y-2 relative">
                    <span class="font-s-14">&nbsp;</span>
                    <div class="w-100  d-flex align-items-center ">
                        <input type="checkbox" name="advancedcheck" id="check" value="true" />
                        <label for="check" class="font-s-14 ms-2">{{ $lang['2'] }} 5%</label>
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
                    <div class="w-full  mt-3">
                        <div class="row">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="text-[#2845F5] py-2 border-b"><?=$lang['3']?> 1:</td>
                                        <td class="py-2 border-b"><strong><?=$lang[4]?> <?=$detail['p']?>th <?=$lang[5]?> <span class="text-[#2845F5]"><?=$detail['final_ans1']?></span></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-[#2845F5] py-2 border-b"><?=$lang['3']?> 2:</td>
                                        <td class="py-2 border-b"><strong><?=$lang[4]?> <?=$detail['p']?>th <?=$lang[5]?> <span class="text-[#2845F5]"><?=$detail['final_ans2']?></span></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-[#2845F5] py-2 border-b"><?=$lang['3']?> 3:</td>
                                        <td class="py-2 border-b"><strong><?=$lang[4]?> <?=$detail['p']?>th <?=$lang[5]?> <span class="text-[#2845F5]"><?=$detail['final_ans']?></span></strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-20"><b class="text-[#2845F5]"><?=$lang[6]?> :</b></p>
                            <p class="col-12 mt-2"> <strong><?=$lang[7]?> </strong> = (<?=$_POST['x']?>)</p>
                            <p class="col-12 mt-2 font-s-18"><b><?=$lang[8]?> 1 <?=$lang[9]?> :</b></p>
                            <p class="col-12 mt-3 font-s-18"><strong class="text-[#2845F5]"><?=$lang[10]?> 1: </strong></p>
                            <p class="col-12 mt-2"><strong><?=$lang[11]?> = </strong>(
                                <?php 
                                    foreach (($detail['numbers']) as $index => $value) { 
                                        if ($detail['numbers']) {
                                        ?>
                                            <span><?php echo ($detail['numbers'])[$index];?> , </span>
                                        <?php
                                        }
                                    }
                                ?>
                            )
                            </p>
                            <p class="col-12 mt-3 font-s-20"><strong class="text-[#2845F5]"><?=$lang[10]?> 2: </strong></p>
                            <p class="col-12 mt-2"><?=$lang[12]?> (<?=$lang[13]?> i):</p>
                            <p class="col-12 mt-2"><strong>i </strong>= (p/100)n, <?=$lang[14]?> <strong>p</strong> = <?=$_POST['p']?> <?=$lang[15]?> <strong>n</strong> = <?=$detail['n']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= (<?=$detail['p']?>/100) * <?=$detail['n']?> = <?=$detail['p_per']?> * <?=$detail['n']?> => <?=$detail['ab']?></p>
                            <p class="col-12 mt-2"><?=$lang[16]?> i = <?=$detail['final_ans11']?>:</p>
                            <p class="col-12 mt-2"><strong>i </strong>= <?=$detail['final_ans1']?></p>
                            <p class="col-12 mt-2 font-s-18"><b><?=$lang[8]?> 2 <?=$lang[9]?> :</b></p>
                            <p class="col-12 mt-3 font-s-20"><strong class="text-[#2845F5]"><?=$lang[10]?> 1: </strong></p>
                            <p class="col-12 mt-2"><strong><?=$lang[11]?> = </strong>(
                            <?php 
                            foreach (($detail['numbers']) as $index => $value) { 
                                if ($detail['numbers']) {
                                ?>
                                <span class="font_size18"><?php echo ($detail['numbers'])[$index];?>,</span>
                                <?php
                                }
                            }
                            ?>
                            )
                            </p>
                            <p class="col-12 mt-3 font-s-20"> <strong class="text-[#2845F5]"><?=$lang[10]?> 2: </strong></p>
                            <p class="col-12 mt-2"><?=$lang[12]?> (<?=$lang[13]?> i):</p>
                            <p class="col-12 mt-2"><strong>i </strong>= (p/100)(n-1) + 1, <?=$lang[14]?> <strong>p</strong> = <?=$_POST['p']?> and <strong>n</strong> = <?=$detail['n']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= (<?=$detail['p']?>/100)(<?=$detail['n']?> - 1) + 1 = <?=$detail['p_per']?> * <?=$detail['n_sum_method2']?> + 1 => <?=$detail['ans_method2']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= <?=$detail['b']?> + (<?=$detail['ans2_method2']?>) * <?=$detail['diff']?> => <?=$detail['b']?> + <?=$detail['ans_diff2']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= <?=$detail['final_ans2']?></p>
                            <p class="col-12 mt-2 font-s-18"> <b><?=$lang[8]?> 3 <?=$lang[9]?> :</b></p>
                            <p class="col-12 mt-3 font-s-20"> <strong class="text-[#2845F5]"><?=$lang[10]?> 1: </strong></p>
                            <p class="col-12 mt-2"><strong><?=$lang[11]?> = </strong>(
                            <?php 
                            foreach (($detail['numbers']) as $index => $value) { 
                                if ($detail['numbers']) {
                                ?>
                                <span class="font_size18"><?php echo ($detail['numbers'])[$index];?>,</span>
                                <?php
                                }
                            }
                            ?>
                            )
                            </p>
                            <p class="col-12 mt-3 font-s-20"> <strong class="text-[#2845F5]"><?=$lang[10]?> 2: </strong></p>
                            <p class="col-12 mt-2"><?=$lang[12]?> (<?=$lang[13]?> i):</p>
                            <p class="col-12 mt-2"><strong>i </strong>= (n+1) * (p/100), <?=$lang[14]?> <strong>p</strong> = <?=$_POST['p']?> and <strong>n</strong> = <?=$detail['n']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= (<?=$detail['n']?> + 1) * (<?=$detail['p']?>/100) = <?=$detail['n_sum']?> * <?=$detail['p_per']?> => <?=$detail['ans']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= <?=$detail['b']?> + (<?=$detail['ans2']?>) * <?=$detail['diff']?> => <?=$detail['b']?> + <?=$detail['ans_diff']?></p>
                            <p class="col-12 mt-2"><strong>i </strong>= <?=$detail['final_ans']?></p>
                            @if (isset($detail['final_ans3']))
                                <div class="col-lg-7 overflow-auto">
                                    <table class="w-100 font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" colspan="2"><?=$lang[17]?></td>
                                        </tr>
                                        <?php 
                                            $i=0;
                                            foreach (($detail['final_ans3']) as $index => $value) {
                                            ?>
                                                <tr>
                                                    <td class="py-2 border-b"><?php echo $i."th"; ?></td>
                                                    <td class="py-2 border-b"><strong><?php echo $value;?></strong></td>
                                                </tr>
                                            <?php
                                                $i=$i+5;
                                            }    
                                        ?>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var x = document.getElementById('seprateby').value;
        var readonlyInputs = document.querySelectorAll('.readonly');

        if (x === 'space') {
            readonlyInputs.forEach(function(input) {
                input.removeAttribute('required');
                input.setAttribute('readonly', 'readonly');
                input.value = '';
            });
            document.getElementById('textarea').value = '12 32 12 33 4 21';
        } else if (x === ',') {
            readonlyInputs.forEach(function(input) {
                input.setAttribute('readonly', 'readonly');
                input.removeAttribute('required');
                input.value = ',';
            });
            document.getElementById('textarea').value = '12, 32, 12, 33, 4, 21';
        } else {
            readonlyInputs.forEach(function(input) {
                input.setAttribute('required', 'required');
                input.removeAttribute('readonly');
                input.value = '';
            });
        }

        document.getElementById('seprateby').addEventListener('change', function() {
            var x = this.value;
            var readonlyInputs = document.querySelectorAll('.readonly');

            if (x === 'space') {
                readonlyInputs.forEach(function(input) {
                    input.removeAttribute('required');
                    input.setAttribute('readonly', 'readonly');
                    input.value = '';
                });
                document.getElementById('textarea').value = '12 32 12 33 4 21';
            } else if (x === ',') {
                readonlyInputs.forEach(function(input) {
                    input.setAttribute('readonly', 'readonly');
                    input.removeAttribute('required');
                    input.value = ',';
                });
                document.getElementById('textarea').value = '12, 32, 12, 33, 4, 21';
            } else {
                readonlyInputs.forEach(function(input) {
                    input.setAttribute('required', 'required');
                    input.removeAttribute('readonly');
                    input.value = '';
                });
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>