<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1     mt-3  gap-4">
                
                <div class="space-y-2">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
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
                                $name = [$lang['2'],$lang['3']];
                                $val = ['space',','];
                                optionsList($val,$name,isset($_POST['seprateby'])?$_POST['seprateby']:'space');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="space-y-2 hidden">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2">
                        <input type="text" name="seprate" id="seprate" value="{{ isset($_POST['seprate'])?$_POST['seprate']:' ' }}" class="input readonly" readonly aria-label="input" placeholder=" " />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 3, 8, 10, 17, 24, 27">{{ isset($_POST['x'])?$_POST['x']:'3 8 10 17 24 27' }}</textarea>
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
                        <div class="col">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[7]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
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
                                        <td class="py-2 border-b"><?=$lang[8]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
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
                                        <td class="py-2 border-b"><?=$lang[9]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <?php 
                                            echo max($detail['numbers']);
                                            ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[10]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <?php 
                                            echo min($detail['numbers']);
                                            ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[11]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <?php 
                                            echo $detail['third'];
                                            ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[12]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <?php 
                                            echo $detail['first'];
                                            ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[13]?>:</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <?php 
                                            echo $detail['median'];
                                            ?>
                                        </strong></td>
                                    </tr>
                                </table>
                            </div>
                            @php
                                $numbers = $detail['numbers'];
                            @endphp
                            <div class="w-full overflow-auto">
                                <div class="w-full mt-3" id="chartContainer"></div>
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
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
        var options = {
            series: [
            {
                name: 'box',
                type: 'boxPlot',
                data: [
                        {
                            x: "boxAndWhisker",
                            y: [<?=min($detail['numbers'])?>, <?=$detail['first']?>, <?=$detail['median']?>, <?=$detail['third']?>, <?=max($detail['numbers'])?>]
                        }
                    ]
                }
            ],
            chart: {
                type: 'boxPlot',
                height: 350
            },
            colors: ['#008FFB', '#FEB019'],
            title: {
                text: 'Box And Whisker Plot',
                align: 'left'
            },
                xaxis: {
                type: 'boxAndWhisker',
            },
            tooltip: {
                shared: false,
                intersect: true
            }
        };
        var chart = new ApexCharts(document.querySelector("#chartContainer"), options);
        chart.render();
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
            // document.getElementById('textarea').value = '3 8 10 17 24 27';
        } else if (x === ',') {
            readonlyInputs.forEach(function(input) {
                input.setAttribute('readonly', 'readonly');
                input.removeAttribute('required');
                input.value = ',';
            });
            // document.getElementById('textarea').value = '3, 8, 10, 17, 24, 27';
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
                document.getElementById('textarea').value = '3 8 10 17 24 27';
            } else if (x === ',') {
                readonlyInputs.forEach(function(input) {
                    input.setAttribute('readonly', 'readonly');
                    input.removeAttribute('required');
                    input.value = ',';
                });
                document.getElementById('textarea').value = '3, 8, 10, 17, 24, 27';
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