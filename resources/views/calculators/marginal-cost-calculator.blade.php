<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 hidden">
                    <div class="row align-items-center bg-white text-center border radius-10 p-1">
                        <div class="col-6 py-2 units_active cursor-pointer radius-5 imperial tb1" id="tb1">
                            {{ $lang['1'] }}
                        </div>
                        <div class="col-6 py-2 cursor-pointer radius-5 metric tb2" id="tb2">
                            {{ $lang['2'] }}
                        </div>
                        <input type="hidden" name="unit_type" id="unit_type" value="sr">
                    </div>
                </div>
            <div class="col-span-12" id="sr">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dc" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="dc" id="dc" class="input"
                            aria-label="input" placeholder="50"
                            value="{{ isset($_POST['dc']) ? $_POST['dc'] : '50' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dq" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="dq" id="dq" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dq']) ? $_POST['dq'] : '40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dq_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dq_unit_dropdown')">{{ isset($_POST['dq_unit'])?$_POST['dq_unit']:'units' }} ▾</label>
                        <input type="text" name="dq_unit" value="{{ isset($_POST['dq_unit'])?$_POST['dq_unit']:'units' }}" id="dq_unit" class="hidden">
                        <div id="dq_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dq_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dq_unit', 'units')">{{ $lang[5] }}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dq_unit', 'pairs')">{{ $lang[6] }}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dq_unit', 'decades')">{{ $lang[7] }}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dq_unit', 'dozens')">{{ $lang[8] }}</p>
                        </div>
                     </div>
                </div>
                </div>
            </div>
            <div class="col-span-12 hidden" id="gr">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cc" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="cc" id="cc" class="input"
                            aria-label="input" placeholder="50"
                            value="{{ isset($_POST['cc']) ? $_POST['cc'] : '50' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fc" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="fc" id="fc" class="input"
                            aria-label="input" placeholder="50"
                            value="{{ isset($_POST['fc']) ? $_POST['fc'] : '50' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cq" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" type="any" name="cq" id="cq"
                            value="{{ isset($_POST['cq']) ? $_POST['cq'] : '30' }}" class="input" aria-label="input"
                            placeholder="50" />
                        <label for="cq_unit"
                            class="text-blue input_unit text-decoration-underline">{{ isset($_POST['cq_unit']) ? $_POST['cq_unit'] : 'units' }}
                            ▾</label>
                        <input type="text" name="cq_unit"
                            value="{{ isset($_POST['cq_unit']) ? $_POST['cq_unit'] : 'units' }}" id="cq_unit"
                            class="hidden">
                        <div class="units cq_unit hidden" to="cq_unit">
                            <p value="units">{{ $lang[5] }}</p>
                            <p value="pairs">{{ $lang[6] }}</p>
                            <p value="decades">{{ $lang[7] }}</p>
                            <p value="dozens">{{ $lang[8] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fq" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" type="any" name="fq" id="fq"
                            value="{{ isset($_POST['fq']) ? $_POST['fq'] : '20' }}" class="input"
                            aria-label="input" placeholder="50" />
                        <label for="fq_unit"
                            class="text-blue input_unit text-decoration-underline">{{ isset($_POST['fq_unit']) ? $_POST['fq_unit'] : 'units' }}
                            ▾</label>
                        <input type="text" name="fq_unit"
                            value="{{ isset($_POST['fq_unit']) ? $_POST['fq_unit'] : 'units' }}" id="fq_unit"
                            class="hidden">
                        <div class="units fq_unit hidden" to="fq_unit">
                            <p value="units">{{ $lang[5] }}</p>
                            <p value="pairs">{{ $lang[6] }}</p>
                            <p value="decades">{{ $lang[7] }}</p>
                            <p value="dozens">{{ $lang[8] }}</p>
                        </div>
                    </div>
                </div>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['mc'], 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>{{ $lang['14'] }}:</strong></p>
                            <p class="mt-2"><strong>{{ $lang['15'] }}</strong></p>
                            <p class="mt-2">{{ $lang['13'] }} = {{ $lang['3'] }} / {{ $lang['4'] }}</p>
                            <p class="mt-2">MC = ΔTC / ΔQ</p>
                            @if ($detail['check'] === 'm2')
                                <p class="mt-2"><strong>{{ $lang['16'] }} ΔTC</strong></p>
                                <p class="mt-2">ΔTC = {{ $lang['10'] }} - {{ $lang['9'] }}</p>
                                <p class="mt-2">ΔTC = {{ $detail['fc'] }} - {{ $detail['cc'] }}</p>
                                <p class="mt-2">ΔTC = {{ round($detail['dc'], 2) }}</p>
                                <p class="mt-2"><strong>{{ $lang['16'] }} ΔQ</strong></p>
                                <p class="mt-2">ΔTC = {{ $lang['12'] }} - {{ $lang['11'] }}</p>
                                <p class="mt-2">ΔTC = {{ $detail['fq'] }} - {{ $detail['cq'] }}</p>
                                <p class="mt-2">ΔTC = {{ $detail['dq'] }} </p>
                            @endif
                            <p class="mt-2"><strong>{{ $lang['17'] }}</strong></p>
                            <p class="mt-2">MC = ΔTC / ΔQ</p>
                            <p class="mt-2">MC = {{ round($detail['dc'], 2) }} / {{ $detail['dq'] }}</p>
                            <p class="mt-2">MC = {{ round($detail['mc'], 2) }}</p>
                        <div class="mt-4 "><strong>{{ $lang['13'] }} {{ $lang['18'] }}</strong></div>
                        <div class="row d-flex">
                            <div style="width: 300px" class="col-12 mt-4">
                                <canvas id="myChart"></canvas>
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
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if (isset($detail))
    var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    'Total Cost',
                    'Marginal Cost'
                ],
                datasets: [{
                    label: 'Marginal Cost',
                    data: [{{ $detail['dc'] }}, {{ round($detail['mc'], 2) }}],
                    backgroundColor: [
                        'rgb(255, 159, 0)',
                        'rgb(0, 194, 219)'
                    ],
                    hoverOffset: 4
                }]
            }
        });
    @endif

    document.querySelectorAll('#tb1').forEach(function(element) {
        element.addEventListener('click', function() {
            this.classList.add('units_active');
            document.querySelectorAll('#tb2').forEach(function(metricElement) {
                metricElement.classList.remove('units_active');
            });
            document.getElementById('unit_type').value = "sr";

            var sr = document.getElementById('sr');
            var gr = document.getElementById('gr');

                if (sr && gr) {
                    sr.classList.remove('hidden');
                    gr.classList.add('hidden');
                }
        });
    });

    document.querySelectorAll('#tb2').forEach(function(element) {
        element.addEventListener('click', function() {
            if (this.classList.contains('tb2')) {
                this.classList.add('units_active');
                document.querySelectorAll('#tb1').forEach(function(imperialElement) {
                    imperialElement.classList.remove('units_active');
                });

                document.getElementById('unit_type').value = "gr";

                var gr = document.getElementById('gr');
                var sr = document.getElementById('sr');

                if (gr && sr) {
                    gr.classList.remove('hidden');
                    sr.classList.add('hidden');
                }
            }
        });
    });

    @if(isset($detail))
        var type = "{{ $_POST['unit_type'] }}";
        if (type == "sr") {
            document.querySelectorAll('#tb1').forEach(function(element) {
                document.getElementById('unit_type').value = "sr";
                var sr = document.getElementById('sr');
                var gr = document.getElementById('gr');
                
                    if (sr && gr) {
                        sr.classList.remove('hidden');
                        gr.classList.add('hidden');
                    }
            })
        } else {
            document.querySelectorAll('#tb2').forEach(function(element) {
                document.getElementById('unit_type').value = "gr";
                var gr = document.getElementById('gr');
                var sr = document.getElementById('sr');

                if (gr && sr) {
                    gr.classList.remove('hidden');
                    sr.classList.add('hidden');
                }
            })

        }
    @endif

    @if(isset($error))
        var type = "{{ $_POST['unit_type'] }}";
        if (type == "sr") {
            document.querySelectorAll('#tb1').forEach(function(element) {
                document.getElementById('unit_type').value = "sr";

                var sr = document.getElementById('sr');
                var gr = document.getElementById('gr');

              
                    if (sr && gr) {
                        sr.classList.remove('hidden');
                        gr.classList.add('hidden');
                    }
                
            })
        } else {
            document.querySelectorAll('#tb2').forEach(function(element) {
                document.getElementById('unit_type').value = "gr";

                var gr = document.getElementById('gr');
                var sr = document.getElementById('sr');

                if (gr && sr) {
                    gr.classList.remove('hidden');
                    sr.classList.add('hidden');
                }
            })

        }
    @endif
</script>
@endpush

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>