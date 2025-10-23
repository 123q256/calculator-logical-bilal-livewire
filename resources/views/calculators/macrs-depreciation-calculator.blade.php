<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <input type="hidden" value="{{$currancy }}" name="mycurrancy" id="mycurrancy" >
            <div class="grid grid-cols-12 mt-3  gap-4">
                
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="basic" class="font-s-14 text-blue">{{ $lang['a'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="basic" id="basic" class="input" aria-label="input" placeholder="700000" value="{{ isset($_POST['basic'])?$_POST['basic']:'700000' }}" />
                    <span class="text-blue input_unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 percent">
                <label for="percent" class="font-s-14 text-blue">{{ $lang['b'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="percent" id="percent" class="input" aria-label="input" placeholder="90" value="{{ isset($_POST['percent'])?$_POST['percent']:'90' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 salvage hidden">
                <label for="sal" class="font-s-14 text-blue">{{ $lang['sal'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="sal" id="sal" class="input" aria-label="input" placeholder="90" value="{{ isset($_POST['sal'])?$_POST['sal']:'90' }}" />
                    <span class="text-blue input_unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="method" class="font-s-14 text-blue">{{ $lang['c'] }}:</label>
                <select name="method" id="method" class="input mt-2">
                    <option value="200"  {{ isset($_POST['method']) && $_POST['method']=='200'?'selected':''}}>200%  {{$lang['1']}}</option>
                    <option value="175" {{ isset($_POST['method']) && $_POST['method']=='175'?'selected':''}}>175%  {{$lang['1']}}</option>
                    <option value="150" {{ isset($_POST['method']) && $_POST['method']=='150'?'selected':''}}>150%  {{$lang['1']}}</option>
                    <option value="125" {{ isset($_POST['method']) && $_POST['method']=='125'?'selected':''}}>125%  {{$lang['1']}}</option>
                    <option value="sl" {{ isset($_POST['method']) && $_POST['method']=='sl'?'selected':''}}>GDS  {{$lang['3']}}</option>
                    <option value="asl" {{ isset($_POST['method']) && $_POST['method']=='asl'?'selected':''}}>ADS  {{$lang['3']}}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 adsp">
                <label for="ads_" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                <select name="ads_" class="input mt-2" id="ads_">
                    <option value="2.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='2.5'?'selected':''}}>ADS 2.5  {{$lang['year']}}</option>
                    <option value="3" {{ isset($_POST['ads_']) && $_POST['ads_']=='3'?'selected':''}}>ADS 3  {{$lang['year']}}</option>
                    <option value="3.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='3.5'?'selected':''}}>ADS 3.5  {{$lang['year']}}</option>
                    <option value="4" {{ isset($_POST['ads_']) && $_POST['ads_']=='4'?'selected':''}}>ADS 4  {{$lang['year']}}</option>
                    <option value="5" {{ isset($_POST['ads_']) && $_POST['ads_']=='5'?'selected':''}}>ADS 5  {{$lang['year']}}</option>
                    <option value="6" {{ isset($_POST['ads_']) && $_POST['ads_']=='6'?'selected':''}}>ADS 6  {{$lang['year']}}</option>
                    <option value="6.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='6.5'?'selected':''}}>ADS 6.5  {{$lang['year']}}</option>
                    <option value="7" {{ isset($_POST['ads_']) && $_POST['ads_']=='7'?'selected':''}}>ADS 7  {{$lang['year']}}</option>
                    <option value="7.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='7.5'?'selected':''}}>ADS 7.5  {{$lang['year']}}</option>
                    <option value="8" {{ isset($_POST['ads_']) && $_POST['ads_']=='8'?'selected':''}}>ADS 8  {{$lang['year']}}</option>
                    <option value="8.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='8.5'?'selected':''}}>ADS 8.5  {{$lang['year']}}</option>
                    <option value="9" {{ isset($_POST['ads_']) && $_POST['ads_']=='9'?'selected':''}}>ADS 9  {{$lang['year']}}</option>
                    <option value="9.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='9.5'?'selected':''}}>ADS 9.5  {{$lang['year']}}</option>
                    <option value="10" {{ isset($_POST['ads_']) && $_POST['ads_']=='10'?'selected':''}}>ADS 10  {{$lang['year']}}</option>
                    <option value="10.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='10.5'?'selected':''}}>ADS 10.5  {{$lang['year']}}</option>
                    <option value="11" {{ isset($_POST['ads_']) && $_POST['ads_']=='11'?'selected':''}}>ADS 11  {{$lang['year']}}</option>
                    <option value="11.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='11.5'?'selected':''}}>ADS 11.5  {{$lang['year']}}</option>
                    <option value="12" {{ isset($_POST['ads_']) && $_POST['ads_']=='12'?'selected':''}}>ADS 12  {{$lang['year']}}</option>
                    <option value="12.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='12.5'?'selected':''}}>ADS 12.5  {{$lang['year']}}</option>
                    <option value="13" {{ isset($_POST['ads_']) && $_POST['ads_']=='13'?'selected':''}}>ADS 13  {{$lang['year']}}</option>
                    <option value="13.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='13.5'?'selected':''}}>ADS 13.5  {{$lang['year']}}</option>
                    <option value="14" {{ isset($_POST['ads_']) && $_POST['ads_']=='14'?'selected':''}}>ADS 14  {{$lang['year']}}</option>
                    <option value="15" {{ isset($_POST['ads_']) && $_POST['ads_']=='14.5'?'selected':''}}>ADS 15  {{$lang['year']}}</option>
                    <option value="16" {{ isset($_POST['ads_']) && $_POST['ads_']=='16'?'selected':''}}>ADS 16  {{$lang['year']}}</option>
                    <option value="16.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='16.5'?'selected':''}}>ADS 16.5  {{$lang['year']}}</option>
                    <option value="17" {{ isset($_POST['ads_']) && $_POST['ads_']=='17'?'selected':''}}>ADS 17  {{$lang['year']}}</option>
                    <option value="18" {{ isset($_POST['ads_']) && $_POST['ads_']=='18'?'selected':''}}>ADS 18  {{$lang['year']}}</option>
                    <option value="19" {{ isset($_POST['ads_']) && $_POST['ads_']=='19'?'selected':''}}>ADS 19  {{$lang['year']}}</option>
                    <option value="20" {{ isset($_POST['ads_']) && $_POST['ads_']=='20'?'selected':''}}>ADS 20  {{$lang['year']}}</option>
                    <option value="22" {{ isset($_POST['ads_']) && $_POST['ads_']=='22'?'selected':''}}>ADS 22  {{$lang['year']}}</option>
                    <option value="24" {{ isset($_POST['ads_']) && $_POST['ads_']=='24'?'selected':''}}>ADS 24  {{$lang['year']}}</option>
                    <option value="25" {{ isset($_POST['ads_']) && $_POST['ads_']=='25'?'selected':''}}>ADS 25  {{$lang['year']}}</option>
                    <option value="26.5" {{ isset($_POST['ads_']) && $_POST['ads_']=='26.5'?'selected':''}}>ADS 26.5  {{$lang['year']}}</option>
                    <option value="28" {{ isset($_POST['ads_']) && $_POST['ads_']=='28'?'selected':''}}>ADS 28  {{$lang['year']}}</option>
                    <option value="30" {{ isset($_POST['ads_']) && $_POST['ads_']=='30'?'selected':''}}>ADS 30  {{$lang['year']}}</option>
                    <option value="35" {{ isset($_POST['ads_']) && $_POST['ads_']=='35'?'selected':''}}>ADS 35  {{$lang['year']}}</option>
                    <option value="39" {{ isset($_POST['ads_']) && $_POST['ads_']=='39'?'selected':''}}>ADS 39  {{$lang['year']}}</option>
                    <option value="40" {{ isset($_POST['ads_']) && $_POST['ads_']=='40'?'selected':''}}>ADS 40  {{$lang['year']}}</option>
                    <option value="45" {{ isset($_POST['ads_']) && $_POST['ads_']=='45'?'selected':''}}>ADS 45  {{$lang['year']}}</option>
                    <option value="50" {{ isset($_POST['ads_']) && $_POST['ads_']=='50'?'selected':''}}>ADS 50  {{$lang['year']}}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden gdsp">
                <label for="period" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                <select name="period" id="period" class="input mt-2">
                    <option value="3"  {{ isset($_POST['period']) && $_POST['period']=='3'?'selected':''}}>3 {{$lang['year']}}</option>
                    <option value="5" {{ isset($_POST['period']) && $_POST['period']=='5'?'selected':''}}>5  {{$lang['year']}}</option>
                    <option value="7" {{ isset($_POST['period']) && $_POST['period']=='7'?'selected':''}}>7  {{$lang['year']}}</option>
                    <option value="10" {{ isset($_POST['period']) && $_POST['period']=='10'?'selected':''}}>10  {{$lang['year']}}</option>
                    <option value="15" {{ isset($_POST['period']) && $_POST['period']=='15'?'selected':''}}>15  {{$lang['year']}}</option>
                    <option value="20" {{ isset($_POST['period']) && $_POST['period']=='20'?'selected':''}}>20  {{$lang['year']}}</option>
                    <option value="25" {{ isset($_POST['period']) && $_POST['period']=='25'?'selected':''}}>25  {{$lang['year']}}</option>
                    <option value="27.5" {{ isset($_POST['period']) && $_POST['period']=='27.5'?'selected':''}}>27.5  {{$lang['year']}}</option>
                    <option value="39" {{ isset($_POST['period']) && $_POST['period']=='39'?'selected':''}}>39  {{$lang['year']}}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 percent">
                <label for="conver" class="font-s-14 text-blue">{{ $lang['e'] }}:</label>
                <select name="conver" id="conver" class="input mt-2">
                    <option value="3" {{ isset($_POST['conver']) && $_POST['conver']=='3'?'selected':''}}>{{$lang['4']}}</option>
                    <option value="1" {{ isset($_POST['conver']) && $_POST['conver']=='1'?'selected':''}}>{{$lang['5']}}</option>
                    <option value="2" {{ isset($_POST['conver']) && $_POST['conver']=='2'?'selected':''}}>{{$lang['6']}}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="date" class="font-s-14 text-blue">{{ $lang['f'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="date"name="date" id="date" class="datepicker input" aria-label="input" value="{{ isset($_POST['date'])?$_POST['date']: date('Y-m-d') }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="round" class="font-s-14 text-blue">{{ $lang['round'] }}:</label>
                <select name="round" id="round" class="input mt-2">
                    <option value="yes" {{ isset($_POST['round']) && $_POST['round']=='3'?'selected':''}}>{{$lang['yes']}}</option>
                    <option value="no" {{ isset($_POST['round']) && $_POST['round']=='1'?'selected':''}}>{{$lang['no']}}</option>
                </select>
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
                    <div class="w-full mt-2 overflow-auto">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['bas'] }} </strong></td>
                                <td class="py-2 border-b"> {{$currancy }} {{ $detail['original'] }}</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['f'] }} </strong></td>
                                <td class="py-2 border-b"> {{ isset($_POST['date'])?$_POST['date']: date('Y-m-d') }}</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['d'] }} </strong></td>
                                <td class="py-2 border-b"> {{(($_POST['method']=='asl')?$_POST['ads_']:$_POST['period']) }}</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['c'] }} </strong></td>
                                <td class="py-2 border-b">
                                @if($_POST['method']=='200')
                                <span>200% {{$lang['1'] }}</span>
                                @elseif($_POST['method']=='175')
                                <span>175% {{$lang['1'] }}</span>
                                @elseif($_POST['method']=='150')
                                <span>150% {{$lang['1'] }}</span>
                                @elseif($_POST['method']=='125')
                                <span>125% {{$lang['1'] }}</span>
                                @elseif($_POST['method']=='sl')
                                <span>GDS {{$lang['3'] }}</span>
                                @else
                                <span>ADS {{$lang['3'] }}</span>
                                @endif
                            </td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['c'] }} </strong></td>
                                <td class="py-2 border-b">
                                @if($_POST['conver']=='1')
                                <span> {{$lang['5'] }}</span>
                                @elseif($_POST['conver']=='2')
                                <span> {{$lang['6'] }}</span>
                                @else
                                <span> {{$lang['4'] }}</span>
                                @endif
                            </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-center text-[15px]">
                        <div class="w-full my-4 overflow-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="grey lighten-3 color_blue">
                                        <th class="py-2 border-b">{{$lang['year']}}</th>
                                        <th class="py-2 border-b">{{$lang['a_b']}}</th>
                                        <th class="py-2 border-b">%</th>
                                        <th class="py-2 border-b">{{$lang['dep']}}</th>
                                        <th class="py-2 border-b">{{$lang['cam']}}</th>
                                        <th class="py-2 border-b">{{$lang['b_v']}}</th>
                                        <th class="py-2 border-b">{{$lang['method']}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($detail)
                                    {!! $detail['output']!!}
                                    @else
                                    <tr>
                                        <td class="border-b">2019</td>
                                        <td class="border-b">0{{$currancy }}</td>
                                        <td class="border-b">0%</td>
                                        <td class="border-b">0{{$currancy }}</td>
                                        <td class="border-b">0{{$currancy }}</td>
                                        <td class="border-b">0{{$currancy }}</td>
                                        <td class="border-b">0{{$currancy }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div id="container" style="width:100%; height:450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
@isset($detail)
    document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: null
                },
                yAxis: {
                    title: {
                        text: '{{$lang['rv']}}'
                    },
                },
                xAxis: {
                    title: {
                        text: '{{$lang['year']}}'
                    },
                    categories: [{{$detail['total_years']}}]
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    x: 3,
                    y: 16,
                    verticalAlign: 'top',
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                tooltip: {
                    crosshairs: true,
                    shared: true,
                    valueSuffix: ' {{$currancy }}'
                },
                series: [{
                    name: '{{$lang['b_v']}}',
                    data: [{{$detail['total_ev']}}]
                }]
            });
    });
@endisset

document.addEventListener("DOMContentLoaded", function() {
    var method = document.getElementById('method').value;
    if (method == 'asl') {
        document.querySelectorAll('.adsp').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.gdsp').forEach(function(element) {
            element.style.display = 'none';
        });
    } else {
        document.querySelectorAll('.adsp').forEach(function(element) {
            element.style.display = 'none';
        });
        document.querySelectorAll('.gdsp').forEach(function(element) {
            element.style.display = 'block';
        });
    }
    document.getElementById('method').addEventListener("change", function() {
        var m = this.value;
        if (m == 'asl') {
            document.querySelectorAll('.adsp').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('.gdsp').forEach(function(element) {
                element.style.display = 'none';
            });
        } else {
            document.querySelectorAll('.adsp').forEach(function(element) {
                element.style.display = 'none';
            });
            document.querySelectorAll('.gdsp').forEach(function(element) {
                element.style.display = 'block';
            });
        }
    });
    var method = document.getElementById('method').value;
    if (method == 'dbl') {
        document.querySelectorAll('.salvage').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.percent').forEach(function(element) {
            element.style.display = 'none';
        });
    } else {
        document.querySelectorAll('.salvage').forEach(function(element) {
            element.style.display = 'none';
        });
        document.querySelectorAll('.percent').forEach(function(element) {
            element.style.display = 'block';
        });
    }
    document.getElementById('method').addEventListener("change", function() {
        var method = this.value;
        if (method == 'dbl') {
            document.querySelectorAll('.salvage').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('.percent').forEach(function(element) {
                element.style.display = 'none';
            });
        } else {
            document.querySelectorAll('.salvage').forEach(function(element) {
                element.style.display = 'none';
            });
            document.querySelectorAll('.percent').forEach(function(element) {
                element.style.display = 'block';
            });
        }
    });
});
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>