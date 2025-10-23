
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-2">
                    <label for="next_birth" class="font-s-14 text-blue">{{ $lang['dob'] }}:</label>
                    <input type="date" name="next_birth" id="next_birth" class="input" aria-label="input" value="{{ isset(request()->next_birth) ? request()->next_birth : '1999-11-05' }}" />
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
                
                <div class="w-full bg-light-blue rounded-[10px] mt-3">
                    <div class="my-2">
                        <div class="lg:w-[100%] text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="w-[55%] border-b py-2"><strong><?=$lang['57']?> :</strong></td>
                                    <td class="border-b py-2"><?=$detail['nextBirth']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        <strong><?=$lang[59]?> <u><?=$lang[60]?></u> <?=$lang[50]?> :</strong>
                                    </td>
                                    <td class="border-b py-2"><?=$detail['half_brdy']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[58]?> :</strong></td>
                                    <td class="border-b py-2"><?=$detail['remDays']?> <?=$lang['days']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong><?=$lang[62]?> :</strong></td>
                                    <td class="py-2"><?=$detail['next_half_r_days']?> <?=$lang['days']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b pb-2 pt-4">
                                        <strong><?=$lang[59]?> <u><?=$lang[61]?></u> <?=$lang[63]?> :</strong>
                                    </td>
                                    <td class="border-b pb-2 pt-4">
                                        <b><?=$detail['Age']?></b> <span class="text-[16px]"><?=$lang['years']?></span>
                                        <b><?=$detail['Age_months']?></b> <span class="text-[16px]"><?=$lang['months']?></span>
                                        <b><?=$detail['Age_days']?></b> <span class="text-[16px]"><?=$lang['days']?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="lg:flex mf:flex">
                        <div class="w-full lg:w-[50%] text-[18px] mt-3">
                            <table class="w-full">
                                <tr>
                                    <td class="w-[85%] border-b py-2"><strong><?=$lang['40']?></strong> :</td>
                                    <td class="border-b py-2"><?=array_sum($detail['totalDays'])?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['41']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][1]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['42']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][2]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['43']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][3]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['44']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][4]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['45']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][5]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['46']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][6]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['47']?></td>
                                    <td class="border-b py-2"><?=$detail['totalDays'][0]?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full lg:w-[50%] flex items-center">
                            <div id="birthDayCart"></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @endisset
</form>
@if(isset($detail))
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
	<!-- <script src="//d26tpo4cm8sb6k.cloudfront.net/highchart/highcharts.js"></script> -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script>
		Highcharts.createElement("link", { href: "https://fonts.googleapis.com/css?family=Lato", rel: "stylesheet", type: "text/css" }, null, document.getElementsByTagName("head")[0]);
		Highcharts.theme = { colors: ["#FF2445", "#00A8F1", "#00D2FF", "#00ECA6", "#00AE28","#D5DC23","#FF681C"], chart: { backgroundColor: null, style: { fontFamily: "Lato" } } };
		Highcharts.setOptions(Highcharts.theme);

			Highcharts.chart('birthDayCart', {
			    chart: {
			        type: 'variablepie', height: "305px"
			    },
			    title: false,
			    tooltip: {
			        headerFormat: '',
			        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
			            '<b>{point.y}</b><br/>'
			    },
			    series: [{
			        minPointSize: 10,
			        innerSize: '20%',
			        zMin: 0,
			        name: 'countries',
			        data: [{
			            name: 'Saturday',
			            y: <?=$detail['totalDays'][0]?>,
			            z: <?=$detail['totalDays'][0]?>,
			        }, {
			            name: 'Sunday',
			            y: <?=$detail['totalDays'][1]?>,
			            z: <?=$detail['totalDays'][1]?>,
			        }, {
			            name: 'Monday',
			            y: <?=$detail['totalDays'][2]?>,
			            z: <?=$detail['totalDays'][2]?>,
			        }, {
			            name: 'Tuesday',
			            y: <?=$detail['totalDays'][3]?>,
			            z: <?=$detail['totalDays'][3]?>,
			        }, {
			            name: 'Wednesday',
			            y: <?=$detail['totalDays'][4]?>,
			            z: <?=$detail['totalDays'][4]?>,
			        }, {
			            name: 'Thursday',
			            y: <?=$detail['totalDays'][5]?>,
			            z: <?=$detail['totalDays'][5]?>,
			        }, {
			            name: 'Friday',
			            y: <?=$detail['totalDays'][6]?>,
			            z: <?=$detail['totalDays'][6]?>,
			        }]
			    }]
			});
	</script>
@endif