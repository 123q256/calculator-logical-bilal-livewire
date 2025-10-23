<form class="row" action="{{ url()->current() }}/" method="POST">
        @csrf
        
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   mt-3  gap-4">
                <div class="col-span-12">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <div class="w-100 py-2 position-relative">
                            <select class="input" name="seprateby" id="seprateby">
                                <option value="space"
                                    {{ isset($_POST['seprateby']) && $_POST['seprateby'] == 'space' ? 'selected' : '' }}>
                                    {{ $lang['2'] }}</option>
                                <option value=","
                                    {{ isset($_POST['seprateby']) && $_POST['seprateby'] == ',' ? 'selected' : '' }}>
                                    {{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2">
                        <textarea name="textarea" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12 32 12 33 4 21"> {{ isset($_POST['textarea'])?$_POST['textarea']:'3 8 10 17 24 27' }}  </textarea>
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
                    <div class="w-full ">
                        @php
                            $min = $detail['min'];
                            $q1 = $detail['first'];
                            $q2 = $detail['second'];
                            $q3 = $detail['third'];
                            $max = $detail['max'];
                        @endphp
                        <div class="flex lg:w-1/2 md:w-1/2 justify-center overflow-auto mt-2 px-2 py-1 bg-white border">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" colspan="2"><b>{{ $lang['6'] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?= $lang['7'] ?>:</td>
                                    <td class="py-2 border-b"><strong>
                                            <?php
                                            echo $min;
                                            ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?= $lang['8'] ?> Q1:</td>
                                    <td class="py-2 border-b"><strong>
                                            <?php
                                            echo $q1;
                                            ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?= $lang['8'] ?> Q2 (<?= $lang['9'] ?>):</td>
                                    <td class="py-2 border-b"><strong>
                                            <?php
                                            echo $q2;
                                            ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?= $lang['8'] ?> Q3:</td>
                                    <td class="py-2 border-b"><strong>
                                            <?php
                                            echo $q3;
                                            ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?= $lang['10'] ?>:</td>
                                    <td class="py-2 border-b"><strong>
                                            <?php
                                            echo $max;
                                            ?>
                                        </strong></td>
                                </tr>
                            </table>
                        </div>
                    @php
                        $data = $detail['numbers'];
                        sort($data);
                        $count = count($data);
                        // Calculate median
                        if ($count % 2 == 0) {
                            $median = ($data[$count / 2 - 1] + $data[$count / 2]) / 2;
                        } else {
                            $median = $data[floor($count / 2)];
                        }
                        // Calculate Q1 (first quartile)
                        $firstHalf = array_slice($data, 0, floor($count / 2));
                        $firstHalfCount = count($firstHalf);
                        if ($firstHalfCount % 2 == 0) {
                            $q1 = ($firstHalf[$firstHalfCount / 2 - 1] + $firstHalf[$firstHalfCount / 2]) / 2;
                        } else {
                            $q1 = $firstHalf[floor($firstHalfCount / 2)];
                        }
                        // Calculate Q3 (third quartile)
                        $secondHalf = array_slice($data, ceil($count / 2));
                        $secondHalfCount = count($secondHalf);
                        if ($secondHalfCount % 2 == 0) {
                            $q3 = ($secondHalf[$secondHalfCount / 2 - 1] + $secondHalf[$secondHalfCount / 2]) / 2;
                        } else {
                            $q3 = $secondHalf[floor($secondHalfCount / 2)];
                        }
                    @endphp
                    @if($count % 2 == 0)
                    <div class="w-full md:w-[60%] lg:w-[60%] text-[16px] p-3 mt-3">
                        <p class="mt-2 text-center"><strong>Step by step solution:</strong></p>
                        <p class="mt-2">The data set is 
                            @php
                                $originalData = $detail['numbers'];
                                echo implode(', ', $originalData);
                            @endphp
                        </p>
                        <p class="mt-2"><strong>Step 1: Arrange the data set in ascending order.</strong></p>
                        <p class="mt-2">
                            @php
                                echo implode(', ', $data);
                            @endphp
                        </p>
                        <p class="mt-2"><strong>Step 2: Calculate the total number of terms “n”</strong></p>
                        <p class="mt-2">Total terms = n = {{ count($detail['numbers']) }}.</p>
                        <p class="mt-2"><strong>Step 3: Find the Median:</strong></p>
                        <p class="mt-2">Median = Median of sorted data set.</p>
                        <p class="mt-2">Sorted data set = 
                            @php
                                echo implode(', ', $data);
                            @endphp
                        </p>
                        <p class="mt-2">Median of sorted data set = 
                            @if($count % 2 == 0)
                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                    <span class="num">{{ $data[$count / 2 - 1] }} + {{ $data[$count / 2] }}</span>
                                    <span class="visually-hidden"> / </span>
                                    <span class="den">2</span>
                                </span>
                            @else
                                {{ $data[floor($count / 2)] }}
                            @endif
                        </p>
                        <p class="mt-2"> Median= {{ $median }}</p>
                        <p class="mt-2"><strong>For Q1:</strong></p>
                        <p class="mt-2">Q1 = central element of first half sorted data set.</p>
                        <p class="mt-2">First half data set = 
                            @php
                                echo implode(', ', $firstHalf);
                            @endphp
                        </p>
                        <p class="mt-2">Q1 = {{ $q1 }}</strong></p>
                        <p class="mt-2"><strong>For Q3:</strong></p>
                        <p class="mt-2">Q3 = central element of second half sorted data set.</p>
                        <p class="mt-2">Second half data set = 
                            @php
                                echo implode(', ', $secondHalf);
                            @endphp
                        </p>
                        <p class="mt-2">Q3 = {{ $q3 }}</p>
                    </div>
                    @else
                    <div class="w-full md:w-[60%] lg:w-[60%] text-[16px] bg-sky border p-3 mt-3">
                        <p class="mt-2 text-center"><strong>Step by step solution:</strong></p>
                        <p class="mt-2">The data set is 
                            @php
                                $originalData = $detail['numbers'];
                                echo implode(', ', $originalData);
                            @endphp
                        </p>
                        <p class="mt-2"><strong>Step 1: Arrange the data set in ascending order.</strong></p>
                        <p class="mt-2">
                            @php
                                echo implode(', ', $data);
                            @endphp
                        </p>
                        <p class="mt-2"><strong>Step 2: Calculate the total number of terms “n”</strong></p>
                        <p class="mt-2">Total terms = n = {{ count($detail['numbers']) }}.</p>
                        <p class="mt-2"><strong>For Median:</strong></p>
                        <p class="mt-2"><strong>The formula for Median is: </strong></p>
                        <p>  Median   \( = \left\{ \frac{2 \times (n + 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median   \( = \left\{ \frac{2 \times ({{ count($detail['numbers']) }}+ 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median   \( = \left\{ \frac{2 \times ({{ count($detail['numbers'])+ 1 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median   \( = \left\{ \frac{ ({{ (count($detail['numbers'])+ 1)*2 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median  =  {{ ((count($detail['numbers'])+ 1)*2)/4 }} term</p>
                        <p>  Median  =  {{ round($q2 ,0)}}</p>
                        <p class="mt-2"><strong>For Q1:</strong></p>
                        <p class="mt-2"><strong>The formula for Q1 is: </strong></p>
                        <p>  Q1   \( = \left\{ \frac{1 \times (n + 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1   \( = \left\{ \frac{1 \times ({{ count($detail['numbers']) }}+ 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1   \( = \left\{ \frac{1 \times ({{ count($detail['numbers'])+ 1 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1   \( = \left\{ \frac{ ({{ (count($detail['numbers'])+ 1)*1 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1  =  {{ ((count($detail['numbers'])+ 1)*1)/4 }} term</p>
                        <p>  Q1  =  {{ round($q1 ,0)}}</p>
                        <p class="mt-2"><strong>For Q3:</strong></p>
                        <p class="mt-2"><strong>The formula for Q3 is: </strong></p>
                        <p>  Q3   \( = \left\{ \frac{3 \times (n + 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3   \( = \left\{ \frac{3 \times ({{ count($detail['numbers']) }}+ 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3   \( = \left\{ \frac{3 \times ({{ count($detail['numbers'])+ 3 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3   \( = \left\{ \frac{ ({{ (count($detail['numbers'])+ 1)*3 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3  =  {{ ((count($detail['numbers'])+ 1)*3)/4 }} term</p>
                        <p>  Q3  =  {{ round($q3 ,0)}}</p>
                    </div>
                    @endif
                        <div id="mychart" class="col-lg-12 mt-3" style="height:400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
    @push('calculatorJS')
    
    @if(isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js" ></link>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endif
        @if (isset($detail))
            <script src="{{ url('assets/js/anychart-base.min.js') }}"></script>
            <script>
                anychart.onDocumentReady(function() {
                    var data = [{
                        x: "5 Number Summary",
                        low: {{ $min }},
                        q1: {{ $q1 }},
                        median: {{ $q2 }},
                        q3: {{ $q3 }},
                        high: {{ $max }}
                    }]
                    chart = anychart.box();
                    series = chart.box(data);
                    chart.container("mychart");
                    chart.draw();
                });
            </script>
        @endif
        <script>
            document.getElementById('seprateby').addEventListener('change', function() {
                var x = this.value;
                if (x === 'space') {
                    document.getElementById('textarea').value = '3 8 10 17 24 27';
                } else if (x === ',') {
                    document.getElementById('textarea').value = '3, 8, 10, 17, 24, 27';
                } 
            });
        </script>
    @endpush
    