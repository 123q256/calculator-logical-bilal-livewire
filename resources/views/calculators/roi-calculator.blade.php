<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12" id="main_div">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="basic_1">
                        <label for="invest" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="invest" id="invest" class="input"
                                aria-label="input" placeholder="10"
                                value="{{ isset($_POST['invest']) ? $_POST['invest'] : '10' }}" min="1" />
                            <span class="text-blue input-unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="basic_2">
                        <label for="return" class="label">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="return" id="return" class="input"
                                aria-label="input" placeholder="20"
                                value="{{ isset($_POST['return']) ? $_POST['return'] : '20' }}" min="1" />
                            <span class="text-blue input-unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="optional">
                        <label for="find" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select class="input" name="find" id="find">
                                <option value="1"
                                    {{ isset($_POST['find']) && $_POST['find'] == '1' ? 'selected' : '' }}>
                                    {{ $lang[7] }} ROI</option>
                                <option value="2"
                                    {{ isset($_POST['find']) && $_POST['find'] == '2' ? 'selected' : '' }}>
                                    {{ $lang[8] }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 se_date" id="select_date">
                        <label for="date" class="label">{{ $lang['9'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select class="input" name="date" id="date">
                                <option value="1"
                                    {{ isset($_POST['date']) && $_POST['date'] == '1' ? 'selected' : '' }}>
                                    {{ $lang[10] }}</option>
                                <option value="2"
                                    {{ isset($_POST['date']) && $_POST['date'] == '2' ? 'selected' : '' }}>
                                    {{ $lang[11] }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden annualized">
                        <label for="annualized" class="label">{{ $lang['7'] }} ROI:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="annualized" id="annualized" class="input"
                                aria-label="input" placeholder="50"
                                value="{{ isset($_POST['annualized']) ? $_POST['annualized'] : '20' }}" min="0"
                                max="10000000" />
                            <span class="text-blue input-unit">{{ $currancy }}</span>
                        </div>
                    </div>
                </div>
                <div class="row " id="se_date">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 se_date date_start">
                            <label for="s_date" class="label">{{ $lang['12'] }} </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="date" name="s_date" id="s_date" class="input" aria-label="input"
                                    placeholder="mm/dd/yyyy"
                                    value="{{ isset($_POST['s_date']) ? $_POST['s_date'] : date('Y-m-d') }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 se_date date_start">
                            <label for="e_date" class="label">{{ $lang['13'] }} </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="date" name="e_date" id="e_date" class="input" aria-label="input"
                                    placeholder="mm/dd/yyyy"
                                    value="{{ isset($_POST['e_date']) ? $_POST['e_date'] : date('Y-m-d', strtotime('+7 days')) }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6  hidden length_units">
                            <label for="length" class="label">{{ $lang['14'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" type="any" name="length" id="length"
                                    value="{{ isset($_POST['length']) ? $_POST['length'] : '30' }}" class="input"
                                    aria-label="input" placeholder="30" />
                                <label for="length_unit"
                                    class="text-blue input-unit text-decoration-underline">{{ isset($_POST['length_unit']) ? $_POST['length_unit'] : 'days' }}
                                    ▾</label>
                                <input type="text" name="length_unit"
                                    value="{{ isset($_POST['length_unit']) ? $_POST['length_unit'] : 'days' }}"
                                    id="length_unit" class="hidden">
                                <div class="units length_unit hidden" to="length_unit">
                                    <p value="{{ $lang[15] }}">{{ $lang[15] }}</p>
                                    <p value="{{ $lang[16] }}">{{ $lang[16] }}</p>
                                    <p value="{{ $lang[17] }}">{{ $lang[17] }}</p>
                                    <p value="{{ $lang[18] }}">{{ $lang[18] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="option">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 ">
                            <label for="compare" class="label">{{ $lang['19'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select class="input" name="compare" id="compare">
                                    <option value="1"
                                        {{ isset($_POST['compare']) && $_POST['compare'] == '1' ? 'selected' : '' }}>
                                        {{ $lang[20] }}</option>
                                    <option value="2"
                                        {{ isset($_POST['compare']) && $_POST['compare'] == '2' ? 'selected' : '' }}>
                                        {{ $lang[21] }} </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 hidden" id="resultss">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 " id="basic_1_compare">
                        <label for="invest_compare" class="label">{{ $lang['4'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="invest_compare" id="invest_compare"
                                class="input" aria-label="input" placeholder="5000"
                                value="{{ isset($_POST['invest_compare']) ? $_POST['invest_compare'] : '5000' }}"
                                min="1" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 " id="basic_2_compare">
                        <label for="return_compare" class="label">{{ $lang['5'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="return_compare" id="return_compare"
                                class="input" aria-label="input" placeholder="3000"
                                value="{{ isset($_POST['return_compare']) ? $_POST['return_compare'] : '3000' }}"
                                min="1" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 " id="optional">
                        <label for="find_compare" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select class="input" name="find_compare" id="find_compare">
                                <option value="1"
                                    {{ isset($_POST['find_compare']) && $_POST['find_compare'] == '1' ? 'selected' : '' }}>
                                    {{ $lang[7] }} ROI</option>
                                <option value="2"
                                    {{ isset($_POST['find_compare']) && $_POST['find_compare'] == '2' ? 'selected' : '' }}>
                                    {{ $lang[8] }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6  hidden annualized_compare" id="basic_3_compare">
                        <label for="annualized_compare" class="label">{{ $lang['7'] }} ROI:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="annualized_compare" id="annualized_compare"
                                class="input" aria-label="input" placeholder="3000"
                                value="{{ isset($_POST['annualized_compare']) ? $_POST['annualized_compare'] : '3000' }}"
                                min="0" max="10000000" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6   date_compare" id="select_date_compare">
                        <label for="date_compare" class="label">{{ $lang['9'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select class="input" name="date_compare" id="date_compare">
                                <option value="1"
                                    {{ isset($_POST['date_compare']) && $_POST['date_compare'] == '1' ? 'selected' : '' }}>
                                    {{ $lang[10] }} </option>
                                <option value="2"
                                    {{ isset($_POST['date_compare']) && $_POST['date_compare'] == '2' ? 'selected' : '' }}>
                                    {{ $lang[11] }} </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12" id="se_date_compare">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6  s_date_compare">
                            <label for="s_date_compare" class="label">{{ $lang['12'] }} </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="date" name="s_date_compare" id="s_date_compare" class="input"
                                    aria-label="input" placeholder="mm/dd/yyyy"
                                    value="{{ isset($_POST['s_date_compare']) ? $_POST['s_date_compare'] : date('Y-m-d') }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6  s_date_compare">
                            <label for="e_date_compare" class="label" id="lb_1">{{ $lang['13'] }}
                            </label>
                            <div class="w-100 py-2 position-relative ">
                                <input type="date" name="e_date_compare" id="e_date_compare" class="input"
                                    aria-label="input" placeholder="mm/dd/yyyy"
                                    value="{{ isset($_POST['e_date_compare']) ? $_POST['e_date_compare'] : date('Y-m-d', strtotime('+7 days')) }}" />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden e_date_compare">
                            <label for="length_compare" class="label">{{ $lang['14'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" type="any" name="length_compare" id="length_compare"
                                    value="{{ isset($_POST['length_compare']) ? $_POST['length_compare'] : '30' }}"
                                    class="input" aria-label="input" placeholder="30" />
                                <label for="length_unit_compare"
                                    class="text-blue input-unit text-decoration-underline">{{ isset($_POST['length_unit_compare']) ? $_POST['length_unit_compare'] : 'days' }}
                                    ▾</label>
                                <input type="text" name="length_unit_compare"
                                    value="{{ isset($_POST['length_unit_compare']) ? $_POST['length_unit_compare'] : 'days' }}"
                                    id="length_unit_compare" class="hidden">
                                <div class="units length_unit_compare hidden" to="length_unit_compare">
                                    <p value="{{ $lang[15] }}">{{ $lang[15] }}</p>
                                    <p value="{{ $lang[16] }}">{{ $lang[16] }}</p>
                                    <p value="{{ $lang[17] }}">{{ $lang[17] }}</p>
                                    <p value="{{ $lang[18] }}">{{ $lang[18] }}</p>
                                </div>
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
                <div class="w-full ">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            @if ($_POST['find'] == '1' && $_POST['date'] == '1')
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[22] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['from'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[23] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['to'] }}</td>
                                    </tr>
                                </table>
                            @endif
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>ROI</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['roi'], 2) }}%</td>
                                </tr>
                                @if (isset($detail['annualized_answer']) != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} ROI</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['annualized_answer'] }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-100 font-s-18">
                                @if ($detail['loss'])
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[24] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $currancy}} {{ $detail['loss'] }}</td>
                                    </tr>
                                @endif
                                @if ($detail['gain'])
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[25] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $currancy}} {{ $detail['gain'] }}</td>
                                    </tr>
                                @endif
                                @if ($detail['time'])
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang[26] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['time'], 2) }}  years</td>
                                    </tr>
                                @endif
                            </table>
                            @php
                                if ($_POST['invest'] <= $_POST['return']) {
                                    $invest_per = $_POST['invest'] / $_POST['return'];
                                    $invest_per = $invest_per * 100;
                                    $profit = 100 - $invest_per;
                                    $dataPoints = [
                                        ['label' => 'Investment', 'y' => $invest_per],
                                        ['label' => 'Profit', 'y' => $profit],
                                    ];
                                } elseif ($_POST['invest'] > $_POST['return']) {
                                    $invest_per = $_POST['return'] / $_POST['invest'];
                                    $invest_per = $invest_per * 100;
                                    $profit = 100 - $invest_per;
                                    $dataPoints = [
                                        ['label' => 'Remaining', 'y' => $invest_per],
                                        ['label' => 'Loss', 'y' => $profit],
                                    ];
                                }
                            @endphp
            
                            <div id="chartContainer" style="height: 270px; width: 100%;" class="mt-3"></div>
                        </div>
                    @if ($_POST['compare']=="2")
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            @if ($_POST['find_compare'] == '1' && $_POST['date_compare'] == '1')
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[22] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['from'] }}</td>
                                    </tr>
            
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[23] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['to'] }}</td>
                                    </tr>
                                </table>
            
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[22] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['from2'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[23] }} ROI</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['to2'] }}</td>
                                    </tr>
                                </table>
                            @endif
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>ROI</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['roi2'], 2) }}  %</td>
                                </tr>
                                @if (@$detail['annualized_answer2'] != '')
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} ROI</strong></td>
                                        <td class="py-2 border-b">  {{ $detail['annualized_answer2'] }} %</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                @if ($detail['loss2'])
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[24] }} </strong></td>
                                        <td class="py-2 border-b"> {{$currancy }} {{ $detail['loss2'] }}</td>
                                    </tr>
                                @endif
                                @if ($detail['gain2'])
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[25] }} </strong></td>
                                        <td class="py-2 border-b"> {{$currancy }} {{ $detail['gain2'] }}</td>
                                    </tr>
                                @endif
                                @if ($detail['time2'])
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[26] }} </strong></td>
                                        <td class="py-2 border-b"> {{$currancy }}   {{ round($detail['time2'], 2) }} years</td>
                                    </tr>
                                @endif
                            </table>
                            @php
                                if ($_POST['invest_compare'] <= $_POST['return_compare']) {
                                    $invest_pers = $_POST['invest_compare'] / $_POST['return_compare'];
                                    $invest_pers = $invest_pers * 100;
                                    $profits = 100 - $invest_pers;
                                    $dataPoints2 = [
                                        ['label' => 'Investment', 'y' => $invest_pers],
                                        ['label' => 'Profit', 'y' => $profits],
                                    ];
                                } elseif ($_POST['invest_compare'] > $_POST['return_compare']) {
                                    $invest_pers = $_POST['return_compare'] / $_POST['invest_compare'];
                                    $invest_pers = $invest_pers * 100;
                                    $profits = 100 - $invest_pers;
                                    $dataPoints2 = [
                                        ['label' => 'Remaining', 'y' => $invest_pers],
                                        ['label' => 'Loss', 'y' => $profits],
                                    ];
                                }
            
                            @endphp
            
                            <div id="chartContainer2" class="mt-3" style="height: 270px; width: 100%;"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
<script>
@if(isset($detail))
    @if ($_POST['compare']=="2")
        window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            animationEnabled: true,
            data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        var charts = new CanvasJS.Chart("chartContainer2", {
            theme: "light2",
            animationEnabled: true,
            data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        charts.render();
        }
    @else
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                animationEnabled: true,
                data: [{
                type: "pie",
                indexLabel: "{y}",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "#36454F",
                indexLabelFontSize: 18,
                indexLabelFontWeight: "bolder",
                showInLegend: true,
                legendText: "{label}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
            }

    @endif
@endif

document.getElementById('find').addEventListener('change', function() {
    var c = this.value;
   
    if (c === "1") {
        var seDateElements = document.querySelectorAll('.se_date');
        var annualizedElements = document.querySelectorAll('.annualized');
        var lengthUnitsElements = document.querySelectorAll('.length_units');
        seDateElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        annualizedElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        lengthUnitsElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }
    if (c === "2") {

      
        var seDateElements = document.querySelectorAll('.se_date');
        var annualizedElements = document.querySelectorAll('.annualized');
        var lengthUnitsElements = document.querySelectorAll('.length_units');
        seDateElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        lengthUnitsElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        annualizedElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
});
// 1
@if(isset($detail))
        var c = "{{$_POST['find']}}";
      
        if (c === "1") {
        var seDateElements = document.querySelectorAll('.se_date');
        var annualizedElements = document.querySelectorAll('.annualized');
        var lengthUnitsElements = document.querySelectorAll('.length_units');
        seDateElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        annualizedElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        lengthUnitsElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }
    if (c === "2") {

        
        var seDateElements = document.querySelectorAll('.se_date');  
        var annualizedElements = document.querySelectorAll('.annualized');
        var lengthUnitsElements = document.querySelectorAll('.length_units');

        seDateElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        lengthUnitsElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        annualizedElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
@endif

document.getElementById('date').addEventListener('change', function() {
    var c = this.value;
    var lengthUnitsElements = document.querySelectorAll('.length_units');
    var dateStartElements = document.querySelectorAll('.date_start');

    if (c === "1") {
        lengthUnitsElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        dateStartElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (c === "2") {
        lengthUnitsElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        dateStartElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }
});

// 2
@if(isset($detail))
    var c = "{{$_POST['date']}}";
    var lengthUnitsElements = document.querySelectorAll('.length_units');
    var dateStartElements = document.querySelectorAll('.date_start');

    if (c === "1") {
        lengthUnitsElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        dateStartElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (c === "2") {
        lengthUnitsElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        dateStartElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }
@endif

document.getElementById('compare').addEventListener('change', function() {
    var c = this.value;
    var resultsElement = document.getElementById('resultss');
    if (c === "1") {
        resultsElement.classList.add('hidden');
    }
    if (c === "2") {
        resultsElement.classList.remove('hidden');
    }
});

// 3
@if(isset($detail))
        var c = "{{$_POST['compare']}}";
        var resultsElement = document.getElementById('resultss');

        if (c === "1") {
            resultsElement.classList.add('hidden');
        }

        if (c === "2") {
            resultsElement.classList.remove('hidden');
        }
@endif


document.getElementById('find_compare').addEventListener('change', function() {
    var c = this.value;
    var sDateCompareElements = document.querySelectorAll('.s_date_compare');
    var annualizedCompareElements = document.querySelectorAll('.annualized_compare');
    var dateCompareElements = document.querySelectorAll('.date_compare');

    if (c === "1") {
        sDateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        annualizedCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        dateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (c === "2") {
        sDateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        annualizedCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        dateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }
});

// 4
@if(isset($detail))
        var c = "{{$_POST['find_compare']}}";
        var sDateCompareElements = document.querySelectorAll('.s_date_compare');
    var annualizedCompareElements = document.querySelectorAll('.annualized_compare');
    var dateCompareElements = document.querySelectorAll('.date_compare');

    if (c === "1") {
        sDateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        annualizedCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        dateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (c === "2") {
        sDateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        annualizedCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        dateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }
@endif


document.getElementById('date_compare').addEventListener('change', function() {
    var c = this.value;
    var eDateCompareElements = document.querySelectorAll('.e_date_compare');
    var sDateCompareElements = document.querySelectorAll('.s_date_compare');

    if (c === "1") {
        eDateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        sDateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (c === "2") {
        sDateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        eDateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
});

// 5
@if(isset($detail))
        var c = "{{$_POST['date_compare']}}";
        var eDateCompareElements = document.querySelectorAll('.e_date_compare');
    var sDateCompareElements = document.querySelectorAll('.s_date_compare');

    if (c === "1") {
        eDateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        sDateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (c === "2") {
        sDateCompareElements.forEach(function(element) {
            element.classList.add('hidden');
        });

        eDateCompareElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
@endif



    // 1
    @if(isset($error))
        var c = "{{$_POST['find']}}";
        if (c === "1") {
            var seDateElements = document.querySelectorAll('.se_date');
            var annualizedElements = document.querySelectorAll('.annualized');
            var lengthUnitsElements = document.querySelectorAll('.length_units');
            seDateElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
            annualizedElements.forEach(function(element) {
                element.classList.add('hidden');
            });
            lengthUnitsElements.forEach(function(element) {
                element.classList.add('hidden');
            });
        }
        if (c === "2") {
            var seDateElements = document.querySelectorAll('.se_date');  
            var annualizedElements = document.querySelectorAll('.annualized');
            var lengthUnitsElements = document.querySelectorAll('.length_units');

            seDateElements.forEach(function(element) {
                element.classList.add('hidden');
            });
            lengthUnitsElements.forEach(function(element) {
                element.classList.add('hidden');
            });
            annualizedElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
    @endif

    // 2
    @if(isset($error))
    var c = "{{$_POST['date']}}";
        var lengthUnitsElements = document.querySelectorAll('.length_units');
        var dateStartElements = document.querySelectorAll('.date_start');

        if (c === "1") {
            lengthUnitsElements.forEach(function(element) {
                element.classList.add('hidden');
            });

            dateStartElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (c === "2") {
            lengthUnitsElements.forEach(function(element) {
                element.classList.remove('hidden');
            });

            dateStartElements.forEach(function(element) {
                element.classList.add('hidden');
            });
        }
    @endif

    // 3
    @if(isset($error))
        var c = "{{$_POST['compare']}}";
            var resultsElement = document.getElementById('resultss');

            if (c === "1") {
                resultsElement.classList.add('hidden');
            }

            if (c === "2") {
                resultsElement.classList.remove('hidden');
            }
    @endif

    // 4
    @if(isset($error))
        var c = "{{$_POST['find_compare']}}";
            var sDateCompareElements = document.querySelectorAll('.s_date_compare');
        var annualizedCompareElements = document.querySelectorAll('.annualized_compare');
        var dateCompareElements = document.querySelectorAll('.date_compare');

        if (c === "1") {
            sDateCompareElements.forEach(function(element) {
                element.classList.remove('hidden');
            });

            annualizedCompareElements.forEach(function(element) {
                element.classList.add('hidden');
            });

            dateCompareElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (c === "2") {
            sDateCompareElements.forEach(function(element) {
                element.classList.add('hidden');
            });

            annualizedCompareElements.forEach(function(element) {
                element.classList.remove('hidden');
            });

            dateCompareElements.forEach(function(element) {
                element.classList.add('hidden');
            });
        }
    @endif

    // 5
    @if(isset($error))
        var c = "{{$_POST['date_compare']}}";
        var eDateCompareElements = document.querySelectorAll('.e_date_compare');
        var sDateCompareElements = document.querySelectorAll('.s_date_compare');

        if (c === "1") {
            eDateCompareElements.forEach(function(element) {
                element.classList.add('hidden');
            });

            sDateCompareElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (c === "2") {
            sDateCompareElements.forEach(function(element) {
                element.classList.add('hidden');
            });

            eDateCompareElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
    @endif

</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>