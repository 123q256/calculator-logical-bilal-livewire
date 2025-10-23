<style>
.circle-color:before {
    content: '';
    display: inline-block;
    height: 14px;
    width: 14px;
    border-radius: 3px;
    margin-right: 12px;
    background-color: currentColor;
    -ms-flex-negative: 0;
    flex-shrink: 0;
}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2 relative">
                    <label for="amount" class="font-s-14 text-blue">{{ $lang['amount'] }}:</label>
                    <input type="number" step="any" name="amount" id="amount" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['amount'])?$_POST['amount']:'30' }}" />
                    <span class="input_unit">{{$currancy }}</span>
                </div>
                <div class="space-y-2">
                    <label for="method" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="method" id="method" class="input">
                        <option value="add"  {{ isset($_POST['method']) && $_POST['method']=='add'?'selected':''}}   >{{$lang['add']}}</option>
                        <option value="not"  {{ isset($_POST['method']) && $_POST['method']=='not'?'selected':''}}  >{{$lang['not']}}</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="vat" class="font-s-14 text-blue">{{ $lang['sale_tax'] }}:</label>
                    <input type="number" step="any" name="vat" id="vat" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['vat'])?$_POST['vat']:'30' }}" />
                    <span class="input_unit">%</span>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue  rounded-lg mt-6">
                        <div class="lg:flex">
                            <div class="lg:w-1/2 w-full px-2 mt-4">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b w-7/10 font-bold">{{ $lang['your_sale'] }}</td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['vatAmount'] }}</td>
                                    </tr>
                                </table>
                                <table class="w-full text-lg mt-4">
                                    <tr>
                                        <td class="py-2 border-b w-7/10 font-bold">Sale Tax Detail</td>
                                        <td class="py-2 border-b w-7/10"></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/10 font-bold">{{ $lang['net_price'] }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}
                                            @if(request()->input('method') == 'add')
                                            {{ request()->input('amount') }}
                                            @else
                                            {{ $detail['netBill'] }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/10 font-bold">{{ $lang['sale_tax'] }}</td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['vatAmount'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/10 font-bold">{{ $lang['sale_tax'] }} (%)</td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $_POST['vat'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/10 font-bold">{{ $lang['gross_price'] }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}
                                            @if(request()->input('method') == 'not')
                                            {{ request()->input('amount') }}
                                            @else
                                            {{ $detail['netBill'] }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="lg:w-1/2 w-full mt-4 overflow-auto">
                                <div id="piechart" class="h-[300px]"></div>
                                <div class="mt-4">
                                    <table class="w-full">
                                        <tr class="border-b">
                                            <td class="text-[#99EA48] px-4 py-2 circle-color"><span>Net Price</span></td>
                                            <td class="text-[#FF6D00] px-4 py-2 circle-color" ><span>Sale Tax</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>
@isset($detail)
@push('calculatorJS')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var interest = <?= isset($detail['vatAmount']) ? $detail['vatAmount'] : 0 ?>;
    var prinaipal = <?php 
        if (isset($_POST['method']) && $_POST['method'] == 'add') {
            echo isset($_POST['amount']) ? $_POST['amount'] : 0;
        } else {
            echo isset($detail['netBill']) ? $detail['netBill'] : 0;
        }
    ?>;
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Net Price',  prinaipal],
            ['Sale Tax', interest]
        ]);
        var options = {
            colors: ['#99EA48', '#FF6D00'],
            slices: {  1: {offset: 0.09}
            },
            legend: 'none'
        };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
</script>
@endpush
@endisset
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>