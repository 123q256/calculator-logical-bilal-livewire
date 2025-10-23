<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
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
                        <input type="text" name="seprate" id="seprate" readonly value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" class="input readonly" aria-label="input" placeholder=" " />
                    </div>

                </div>
                <div class="grid grid-cols-1  gap-4">
                    <div class="space-y-2">
                        <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 55 62 35 32 50 57 54">{{ isset($_POST['x'])?$_POST['x']:'55 62 35 32 50 57 54' }}</textarea>
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
                        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 ">
                            <div class="">
                                <div class="rounded-lg  ">
                                    <div class="w-full lg:p-3 md:p-3  mt-3">
                                        <div class="w-full text-center font-s-16">
                                            <p><strong>{{ $lang['ans'] }} {{ $lang['stat']}}</strong></p>
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white text-[24px] rounded-lg px-3 py-2 ">{{ $detail['ss']}} </strong></p>
                                        </div>
                                        <div class="w-full text-center font-s-16">
                                            <p><strong>{{ $lang['ans'] }} {{ $lang['algbra']}}</strong></p>
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white text-[24px] rounded-lg px-3 py-2">{{ $detail['su']}} </strong></p>
                                        </div>
                                        <div class="row  lg:p-5 md:p-5 p-2 border rounded-lg bg-white mt-3">
                                            <p class="col-12 mt-2 px-lg-2 px-0 font-s-20 text-center"> <b>Step by Step Solution</b></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0 font-s-18 text-center"> <strong class="text-blue"><?=$lang['stat']?>  </strong> </p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"> <strong><?=$lang['sdata']?> </strong> = (<?=$_POST['x']?>)</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"><strong><?=$lang['tdata']?> </strong>: <?=$detail['n']?></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"><strong><?=$lang['mean']?> (X̄)</strong> = <?=$detail['so']?> / <?=$detail['n']?> = <?=$detail['s']?></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"> <strong><?=$lang['sum']?></strong> = Σ (Xi - X̄)</p>
                                            <p class=" col-12 mt-2 px-lg-2 px-0">= <?=$detail['sns']?></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= <?=$detail['snns']?></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= "<?=$detail['ss']?>"</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0 font-s-18 text-center"> <strong class="text-blue"><?=$lang['algbra']?> </strong> </p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= <?=$detail['soa']?></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= <?=$detail['soas']?></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= "<?=$detail['su']?>"</p>
                                        </div>
                                    </div>
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
        document.getElementById('textarea').value = '55 62 35 32 50 57 54';
    } else if (x === ',') {
        readonlyInputs.forEach(function(input) {
            input.setAttribute('readonly', 'readonly');
            input.removeAttribute('required');
            input.value = ',';
        });
        document.getElementById('textarea').value = '55, 62, 35, 32, 50, 57, 54';
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
            document.getElementById('textarea').value = '55 62 35 32 50 57 54';
        } else if (x === ',') {
            readonlyInputs.forEach(function(input) {
                input.setAttribute('readonly', 'readonly');
                input.removeAttribute('required');
                input.value = ',';
            });
            document.getElementById('textarea').value = '55, 62, 35, 32, 50, 57, 54';
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