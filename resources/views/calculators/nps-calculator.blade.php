<style>
.cart-h400 {
    height: 400px;
}

</style>


<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="score_ten" class="font-s-14 text-blue">{{ $lang['1'] }} 10 😍:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_ten" id="score_ten" class="input"
                            aria-label="input" placeholder="10"
                            value="{{ isset($_POST['score_ten']) ? $_POST['score_ten'] : '10' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_nine" class="font-s-14 text-blue">{{ $lang['1'] }} 9 😍:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_nine" id="score_nine" class="input"
                            aria-label="input" placeholder="20"
                            value="{{ isset($_POST['score_nine']) ? $_POST['score_nine'] : '20' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_eight" class="font-s-14 text-blue">{{ $lang['1'] }} 8 😐:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_eight" id="score_eight" class="input"
                            aria-label="input" placeholder="30"
                            value="{{ isset($_POST['score_eight']) ? $_POST['score_eight'] : '30' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_seven" class="font-s-14 text-blue">{{ $lang['1'] }} 7 😐:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_seven" id="score_seven" class="input"
                            aria-label="input" placeholder="40"
                            value="{{ isset($_POST['score_seven']) ? $_POST['score_seven'] : '40' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_six" class="font-s-14 text-blue">{{ $lang['1'] }} 6 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_six" id="score_six" class="input"
                            aria-label="input" placeholder="50"
                            value="{{ isset($_POST['score_six']) ? $_POST['score_six'] : '50' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_five" class="font-s-14 text-blue">{{ $lang['1'] }} 5 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_five" id="score_five" class="input"
                            aria-label="input" placeholder="10"
                            value="{{ isset($_POST['score_five']) ? $_POST['score_five'] : '10' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_four" class="font-s-14 text-blue">{{ $lang['1'] }} 4 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_four" id="score_four" class="input"
                            aria-label="input" placeholder="20"
                            value="{{ isset($_POST['score_four']) ? $_POST['score_four'] : '20' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_three" class="font-s-14 text-blue">{{ $lang['1'] }} 3 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_three" id="score_three" class="input"
                            aria-label="input" placeholder="30"
                            value="{{ isset($_POST['score_three']) ? $_POST['score_three'] : '30' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_two" class="font-s-14 text-blue">{{ $lang['1'] }} 2 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_two" id="score_two" class="input"
                            aria-label="input" placeholder="40"
                            value="{{ isset($_POST['score_two']) ? $_POST['score_two'] : '40' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_one" class="font-s-14 text-blue">{{ $lang['1'] }} 1 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_one" id="score_one" class="input"
                            aria-label="input" placeholder="40"
                            value="{{ isset($_POST['score_one']) ? $_POST['score_one'] : '40' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="score_zero" class="font-s-14 text-blue">{{ $lang['1'] }} 0 😒:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="score_zero" id="score_zero" class="input"
                            aria-label="input" placeholder="40"
                            value="{{ isset($_POST['score_zero']) ? $_POST['score_zero'] : '40' }}" />
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
                <div class="w-full">
                    <div class="w-full mt-3">
                        <div class="row">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[2] }} (NPS)</strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['answer'], 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }}
                                                ({{ $lang[4] }} 😍)</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['good'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }}
                                                ({{ $lang[6] }} 😐)</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['neutral'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }}
                                                ({{ $lang[8] }} 😐)</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['bad'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['total'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="w-full  font-s-16">
                                <p class="mt-3"><strong>{{ $lang[10] }}</strong></p>
                                <p class="mt-2">{{ $lang[11] }}.</p>
                                <p class="mt-2">{{ $lang[9] }}= {{ $lang[1] }} 10 + {{ $lang[1] }} 9 +
                                    {{ $lang[1] }} 8 + {{ $lang[1] }} 7 + {{ $lang[1] }} 6 + {{ $lang[1] }}
                                    5 + {{ $lang[1] }} 4 + {{ $lang[1] }} 3 + {{ $lang[1] }} 2 +
                                    {{ $lang[1] }} 1 + {{ $lang[1] }} 0 </p>
                                <p class="mt-2">{{ $lang[9] }}= {{ $detail['score_ten'] }} + {{ $detail['score_nine'] }}
                                    + {{ $detail['score_eight'] }} + {{ $detail['score_seven'] }} + {{ $detail['score_six'] }} +
                                    {{ $detail['score_five'] }} + {{ $detail['score_four'] }} + {{ $detail['score_three'] }} +
                                    {{ $detail['score_two'] }} + {{ $detail['score_one'] }} + {{ $detail['score_zero'] }} </p>
                                <p class="mt-2">{{ $lang[9] }}= <?= round($detail['total']) ?> </p>
                                <p class="mt-2">{{ $lang[12] }}.</p>
                                <p class="mt-2">{{ $lang[3] }}= {{ $lang[1] }} 10 + {{ $lang[1] }} 9</p>
                                <p class="mt-2">{{ $lang[3] }}= {{ $detail['score_ten'] }} + {{ $detail['score_nine'] }}
                                </p>
                                <p class="mt-2">{{ $lang[3] }}= {{ round($detail['good'], 4) }}</p>
                                <p class="mt-2">{{ $lang[13] }}.</p>
                                <p class="mt-2">{{ $lang[5] }}= {{ $lang[1] }} 8 + {{ $lang[1] }} 7</p>
                                <p class="mt-2">{{ $lang[5] }}= {{ $detail['score_eight'] }} +
                                    {{ $detail['score_seven'] }}</p>
                                <p class="mt-2">{{ $lang[5] }}= {{ round($detail['neutral'], 4) }}</p>
                                <p class="mt-2">{{ $lang[14] }}.</p>
                                <p class="mt-2">{{ $lang[7] }}= {{ $lang[1] }} 6 + {{ $lang[1] }} 5 +
                                    {{ $lang[1] }} 4 + {{ $lang[1] }} 3 + {{ $lang[1] }} 2 + {{ $lang[1] }}
                                    1 + {{ $lang[1] }} 0 </p>
                                <p class="mt-2">{{ $lang[7] }}= {{ $detail['score_six'] }} + {{ $detail['score_five'] }}
                                    + {{ $detail['score_four'] }} + {{ $detail['score_three'] }} + {{ $detail['score_two'] }} +
                                    {{ $detail['score_one'] }} + {{ $detail['score_zero'] }}</p>
                                <p class="mt-2">{{ $lang[7] }}= {{ round($detail['bad'], 4) }}</p>
                                <p class="mt-2">{{ $lang[15] }} (NPS).</p>
                                <p class="mt-2">{{ $lang[2] }}= ({{ $lang[3] }} / {{ $lang[9] }} -
                                    {{ $lang[7] }} / {{ $lang[9] }}) x 100</p>
                                <p class="mt-2">{{ $lang[2] }}= ({{ round($detail['good'], 4) }} /
                                    <?= round($detail['total']) ?> - <?= round($detail['bad'], 4) ?> /
                                    <?= round($detail['total']) ?>) x 100</p>
                                <p class="mt-2">{{ $lang[2] }}= {{ round($detail['answer'], 4) }}</p>
                                <p class="mt-2">{{ $lang[16] }}! 😵</p>
            
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div id="chartContainers" class="cart-h400"></div>
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
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        @if (isset($detail))
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainers", {
                    animationEnabled: true,
                    title: {
                        text: "CHART"
                    },
                    data: [{
                        type: "pie",
                        startAngle: 240,
                        indexLabel: "{label} {y}",
                        dataPoints: [{
                                y: {{ $detail['good'] }},
                                label: "{{ $lang[3] }} ({{ $lang[4] }} 😍)"
                            },
                            {
                                y: {{ $detail['neutral'] }},
                                label: "{{ $lang[5] }} ({{ $lang[6] }} 😐)"
                            },
                            {
                                y: {{ $detail['bad'] }},
                                label: "{{ $lang[7] }} ({{ $lang[8] }} 😒)"
                            },
                        ]
                    }]
                });
                chart.render();
            }
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>