<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
             
                <div class="col-span-8 px-2">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['no'] }}:</label>
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
                                $name = [$lang['Space'],$lang['comma'],$lang['user']];
                                $val = ['space',',','user'];
                                optionsList($val,$name,isset($_POST['seprateby'])?$_POST['seprateby']:'space');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-4 px-2">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2">
                        <input type="text" name="seprate" id="seprate" value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" readonly class="input readonly" aria-label="input" placeholder=" " />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 55 62 35 32 50 57 54">{{ isset($_POST['x'])?$_POST['x']:'55 62 35 32 50 57 54' }}</textarea>
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
                                <p class="text-[25px]">
                                    <strong>{{ $lang['17'] }} (H)</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ number_format($detail['shannon_diversity']*(-1),2) }}</strong>
                                </p>
                            </div>
                        </div>
                            <div class="w-full mt-2 overflow-auto">
                                <table class='w-100' style='border-collapse: collapse'>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[1] ?>/<?= $lang[2] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round(($detail['shannon_diversity'] / $detail['count_elements']) * (-1), 4) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[3] ?></strong></td>
                                        <td class='border p-2 text-center'><span class=" font_s20"><strong><?= ($detail['hitman']) ?></strong></span></td>
                                    </tr>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[4] ?></strong></td>
                                        <td class='border p-2 text-center'><span class=" font_s20"><strong><?= ($detail['sum']) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[5] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round(($detail['sum']) / ($detail['hitman']), 4) ?></strong></span></td>
                                    </tr>
                                    <tr class='bg-white'>
                
                                    </tr>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[6] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round((($detail['hitman'] - 1) / log($detail['sum'])), 4) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[7] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round($detail['max'] / $detail['sum'], 4) ?></strong></span></td>
                                    </tr>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[8] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round($detail['sum'] / $detail['max'], 4) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[9] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round($detail['simpson_index'], 4) ?></strong></span></td>
                                    </tr>
                
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[10] ?></strong></p>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round(1 - $detail['simpson_index'], 4) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[11] ?></strong></p>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round(1 / $detail['simpson_index'], 4) ?></strong></span></td>
                                    </tr>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[12] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round($detail['hitman'] / sqrt($detail['sum']), 4) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[13] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round($detail['sum3'], 4) ?></strong></span></td>
                                    </tr>
                                    <tr class='bg-white'>
                
                                    </tr>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[14] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round(1 / $detail['sum3'], 4) ?></strong></span></td>
                                        <td class='border p-2 text-center'><strong><?= $lang[15] ?></strong></td>
                                        <td class='border p-2 text-center'><span class="font_s20"><strong><?= round(1 - $detail['sum3'], 4) ?></strong></span></td>
                                    </tr>
                                    <tr class='bg-white'>
                                        <td class='border p-2 text-center'><strong><?= $lang[16] ?></strong></td>
                                        <td class='border p-2 text-center'>
                                            <p class="font_s20"><strong><?= exp($detail['shannon_diversity'] * (-1)) / $detail['hitman'] ?></strong></p>
                                        </td>
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
            // document.getElementById('textarea').value = '12 32 12 33 4 21';
        } else if (x === ',') {
            readonlyInputs.forEach(function(input) {
                input.setAttribute('readonly', 'readonly');
                input.removeAttribute('required');
                input.value = ',';
            });
            // document.getElementById('textarea').value = '12, 32, 12, 33, 4, 21';
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