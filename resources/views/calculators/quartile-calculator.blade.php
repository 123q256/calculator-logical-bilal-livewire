<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['by'] }}:</label>
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
                                $name = [$lang['space'],$lang['coma']];
                                $val = ['space',','];
                                optionsList($val,$name,isset($_POST['seprateby'])?$_POST['seprateby']:'space');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="space-y-2 hidden">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2">
                        <input type="text" name="seprate" id="seprate" value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" class="input readonly" aria-label="input" placeholder=" " />
                    </div>
                </div>
                <div class="space-y-2 raw_mean">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
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
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-2">
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['qu'] }} Q1</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['first'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['qu'] }} Q2</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['second'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['qu'] }} Q3</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['third'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['iqr'] }} IQR</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['iter'] }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1   mt-3  gap-4">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 px-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['ave']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo $detail['average'];
                                            ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['geo']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo round(pow(array_product($detail['numbers']), (1/$detail['count'])),4);
                                            ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['sum']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo array_sum($detail['numbers']);
                                            ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['psd']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo ($detail['s_d_p']);
                                            ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['ssd']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo ($detail['s_d_s']);
                                            ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['range']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo max($detail['numbers']) - min($detail['numbers']);
                                            ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['count']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo count($detail['numbers']);
                                            ?>
                                    </strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full overflow-auto">
                            <div id="mychart" class="w-full mt-3" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?=url('assets/js/qchart.js')?>"></script>
        <script>
            function chart() {
                var first = [],
                    second = [],
                    third = [],
                    fourth = [];

                first.push([<?=$detail['a1']?>, 1]);
                first.push([<?=$detail['first']?>, 1]);
                second.push([<?=$detail['first']?>, 1]);
                second.push([<?=$detail['second']?>, 1]);
                third.push([<?=$detail['second']?>, 1]);
                third.push([<?=$detail['third']?>, 1]);
                fourth.push([<?=$detail['third']?>, 1]);
                fourth.push([<?=$detail['a2']?>, 1]);

                var options = {
                    xaxis: { min: <?=$detail['numbers'][0]-1?>, max: <?=$detail['numbers'][$detail['count']-1]+1?> },
                    legend: { position: "sw", backgroundColor: "#FFFFFF" },
                    yaxis: {
                        ticks: [
                            [0, ""],
                            [1, ""],
                            [2, ""],
                        ],
                        min: 0,
                        max: 2,
                    },
                    grid: { backgroundColor: "#fafafa" },
                };

                var data = [
                    { label: "<?=$lang['qu']?> Q1 ( <?=$detail['a1']?> &ndash; <?=$detail['first']?> )", data: first, points: { show: true }, lines: { show: true }, color: "#fda400" },
                    { label: "<?=$lang['qu']?> Q2 ( <?=$detail['first']?> &ndash; <?=$detail['second']?> )", data: second, points: { show: true, lineWidth: 4 }, lines: { show: true }, color: "#0081B0" },
                    { label: "<?=$lang['qu']?> Q3 ( <?=$detail['second']?> &ndash; <?=$detail['third']?> )", data: third, points: { show: true, lineWidth: 4 }, lines: { show: true }, color: "#9ccc65" },
                    { label: "<?=$lang['qu']?> Q4 ( <?=$detail['third']?> &ndash; <?=$detail['a2']?> )", data: fourth, points: { show: true }, lines: { show: true }, color: "#795548" },
                ];

                // Initialize Flot chart
                var myChart = document.getElementById("mychart");
                $.plot(myChart, data, options);
            }
            chart()
        </script>
    @endif
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