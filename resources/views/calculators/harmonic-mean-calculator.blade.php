<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    
                    <div class="col-span-8 px-2">
                        <label for="seprateby" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 position-relative">
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
                                    $name = [$lang['2'],$lang['3'],$lang['4']];
                                    $val = ['space',',','user'];
                                    optionsList($val,$name,isset($_POST['seprateby'])?$_POST['seprateby']:'space');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4 px-2">
                        <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">
                            <input type="text" name="seprate" id="seprate" readonly value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" class="input readonly" aria-label="input" placeholder=" " />
                        </div>
                    </div>
                    <div class="col-span-12 px-2">
                        <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2">
                            <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12 32 12 33 4 21">{{ isset($_POST['x'])?$_POST['x']:'12 32 12 33 4 21' }}</textarea>
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
                           
                            <p class="text-[20px]"><strong>{{ $lang['9'] }}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[25px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-blue">{{ $detail['ans'] }}</strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 px-2">
                            <table class="w-100 font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['10']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($key==($detail['count']-1)) {
                                                    echo $value;
                                                }else{
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['11']?>:</td>
                                    <td class="py-2 border-b"><strong>
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
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['12']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($value % 2==0) {
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['13']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($value % 2) {
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['14']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo array_sum($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['15']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo max($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['16']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo min($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['17']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo count($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                            </table>
                        </div>
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