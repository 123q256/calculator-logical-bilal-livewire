<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="space-y-2">
                <label for="type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="type" id="type">
                        <option value="Salary"  {{ isset($_POST['type']) && $_POST['type']=='Salary'?'selected':''}}> {{$lang['2']}} </option>
                        <option value="Bonus"  {{ isset($_POST['type']) && $_POST['type']=='Bonus'?'selected':''}}> {{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label for="pay_frequency" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="pay_frequency" id="pay_frequency">
                        <option value="Daily"  {{ isset($_POST['pay_frequency']) && $_POST['pay_frequency']=='Daily'?'selected':''}}> {{$lang['5']}} </option>
                        <option value="Weekly"  {{ isset($_POST['pay_frequency']) && $_POST['pay_frequency']=='Weekly'?'selected':''}}> {{$lang['6']}}</option>
                        <option value="Bi-Weekly"  {{ isset($_POST['pay_frequency']) && $_POST['pay_frequency']=='Bi-Weekly'?'selected':''}}> {{$lang['7']}}</option>
                        <option value="Semi-Monthly"  {{ isset($_POST['pay_frequency']) && $_POST['pay_frequency']=='Semi-Monthly'?'selected':''}}> {{$lang['8']}}</option>
                        <option value="Monthly"  {{ isset($_POST['pay_frequency']) && $_POST['pay_frequency']=='Monthly'?'selected':''}}> {{$lang['9']}}</option>
                        <option value="Quarterly"  {{ isset($_POST['pay_frequency']) && $_POST['pay_frequency']=='Quarterly'?'selected':''}}> {{$lang['10']}}</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label for="filer_status" class="font-s-14 text-blue">{{ $lang['31'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="filer_status" id="filer_status">
                        <option value="single"  {{ isset($_POST['filer_status']) && $_POST['filer_status']=='single'?'selected':''}}> {{$lang['32']}} </option>
                        <option value="married-jointly"  {{ isset($_POST['filer_status']) && $_POST['filer_status']=='married-jointly'?'selected':''}}> {{$lang['33']}}</option>
                        <option value="married-separately"  {{ isset($_POST['filer_status']) && $_POST['filer_status']=='married-separately'?'selected':''}}> {{$lang['34']}}</option>
                        <option value="head"  {{ isset($_POST['filer_status']) && $_POST['filer_status']=='head'?'selected':''}}> {{$lang['35']}}</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2 pay_method">
                <label for="pay_method" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="pay_method" id="pay_method">
                        <option value="Per-Period"  {{ isset($_POST['pay_method']) && $_POST['pay_method']=='Per-Period'?'selected':''}}> {{$lang['12']}} </option>
                        <option value="Per-Year"  {{ isset($_POST['pay_method']) && $_POST['pay_method']=='Per-Year'?'selected':''}}> {{$lang['13']}}</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label for="amount" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="amount" id="amount" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['amount'])?$_POST['amount']:'10000' }}" />
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
                    <div class="col-12 px-2 font-s-20">
                        <div class="col">
                            <div class="col-12  text-[16px]">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang[21]}}</strong> 
                                            <sub>
                                                @if($detail['filer_status'] == "single")
                                                {{ $lang[32]}}
                                                @elseif($detail['filer_status'] == "married-jointly")
                                                {{ $lang[33]}}
                                                @elseif($detail['filer_status'] == "married-separately")
                                                {{ $lang[34]}}
                                                @elseif($detail['filer_status'] == "head")
                                                {{ $lang[35]}}
                                                @endif
                                            </sub>
                                        </td>
                                        <td class="py-2 border-b"><strong>{{ $lang[22]}}(%)</strong></td>
                                        <td class="py-2 border-b"><strong>
                                                @if($detail['pay_frequency'] == "Daily")
                                                {{$lang[5]}}
                                                @elseif($detail['pay_frequency'] == "Weekly")
                                                {{$lang[6]}}
                                                @elseif($detail['pay_frequency'] == "Bi-Weekly")
                                                {{$lang[7]}}
                                                @elseif($detail['pay_frequency'] == "Semi-Monthly")
                                                {{$lang[8]}}
                                                @elseif($detail['pay_frequency'] == "Monthly")
                                                {{$lang[9]}}
                                                @elseif($detail['pay_frequency'] == "Quarterly")
                                                {{$lang[10]}}
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b"><strong>{{ $lang[23]}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ ($type == "Salary") ? $lang[24] : $lang[25]}}</td>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['per_frequency']}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['total_amount']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang[26] }}</td>
                                        <td class="py-2 border-b">{{ $detail['tax_per'] }}%</td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['tax_amount_frequency']}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['tax_amount_yearly']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang[27]}}</td>
                                        <td class="py-2 border-b">{{ $detail['secrity_per']}}%</td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['secrity_amount_frequency']}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['secrity_amount_yearly']}}</strong></td>
                                    </tr>
                                    <tr> 
                                        <td class="py-2 border-b">{{$lang[28] }} </td>
                                        <td class="py-2 border-b"> {{ $detail['medicare_per']}}%</td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['medicare_amount_frequency']}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$currancy }} {{ $detail['medicare_amount_yearly'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ ($type == "Salary") ? $lang[29] : $lang[30] }}</td>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b">{{$currancy }} <strong>{{ $detail['net_frequency_amount'] }}</strong></td>
                                        <td class="py-2 border-b">{{$currancy }} <strong>{{ $detail['yearly_net_income'] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 mt-3">
                                @php
                                if ($detail['net_income_per'] && $detail['net_tax_per']) {
                                $dataPoints = array( 
                                    array("label" => "Take Home", "y"=> $detail['net_income_per']),
                                    array("label" => "Tax", "y"       => $detail['net_tax_per'])
                                );
                                }
                                @endphp
                            <p class=" my-2">
                                @if($detail['pay_frequency'] == "Daily")
                                    {{$lang[15]}}
                                @elseif($detail['pay_frequency'] == "Weekly")
                                    {{$lang[16]}}
                                @elseif($detail['pay_frequency'] == "Bi-Weekly")
                                    {{$lang[17]}}
                                @elseif($detail['pay_frequency'] == "Semi-Monthly")
                                    {{$lang[18]}}
                                @elseif($detail['pay_frequency'] == "Monthly")
                                    {{$lang[19]}}
                                @elseif($detail['pay_frequency'] == "Quarterly")
                                    {{$lang[20]}}
                                @endif
                                {{$currancy }} <strong>{{ $detail['net_frequency_amount']}}</strong></strong>
                            </p>
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    document.getElementById('type').addEventListener('change', function() {
    var type = this.value;
    var typeElements = document.querySelectorAll('.pay_method');

    if (type === 'Salary') {
        typeElements.forEach(function(element) {
            element.style.display = 'block';
        });
    } else {
        typeElements.forEach(function(element) {
            element.style.display = 'none';
        });
    }
});
</script>

@if(isset($detail))
  
    <script>
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
   
    var dropVals = "{{$detail['type']}}";
    var otherElements = document.querySelectorAll('.pay_method');

    if (dropVals === 'Salary') {
        otherElements.forEach(function(element) {
            element.style.display = 'block';
        });
    } else if (dropVals === 'Bonus') {
        otherElements.forEach(function(element) {
            element.style.display = 'none';
        });
    }
@endif
</script>

@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>