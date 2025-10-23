<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cs" class="label">{{ $lang['cs'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="cs" id="cs" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['cs'])?$_POST['cs']:'10' }}" />
                        <span class="input_unit">{{$currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ps" class="label">{{ $lang['ps'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="ps" id="ps" class="input" aria-label="input" placeholder="15" value="{{ isset($_POST['ps'])?$_POST['ps']:'15' }}" />
                        <span class="input_unit">{{$currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mvd" class="label">{{ $lang['mvd'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="mvd" id="mvd" class="input" aria-label="input" placeholder="25" value="{{ isset($_POST['mvd'])?$_POST['mvd']:'25' }}" />
                        <span class="input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mi" class="label">{{ $lang['mi'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="mi" id="mi" class="input" aria-label="input" placeholder="30" value="{{ isset($_POST['mi'])?$_POST['mi']:'30' }}" />
                        <span class="input_unit">{{$currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ce" class="label">{{ $lang['ce'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="ce" id="ce" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['ce'])?$_POST['ce']:'35' }}" />
                        <span class="input_unit">{{$currancy }}</span>
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
                    <div class="w-full text-[25px] text-center my-3">
                        <p>{{ $lang['ev'] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[30px] rounded-lg radius-10 text-white">
                            @if($detail['ev'])
                            {{$currancy }}  {{$detail['ev']}}
                            @else
                            <span> {{$currancy }} 0.0 </span>
                            @endif
                        </strong></p>
                    </div>
                    <div class="w-full md:w-[60%] lg:w-[60%]  mx-auto">
                        <div id="container" style="width:100%; height:250px;"></div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
@isset($detail)
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    	document.addEventListener('DOMContentLoaded', function () {
	        var myChart = Highcharts.chart('container', {
	            chart: {
	                type: 'bar'
	            },
	            title: {
	                text: null
	            },
	            xAxis: {
	                categories: ['MC','PS','MVD','MI','CCE']
	            },
	            yAxis: {
			        title: {
			            text: null
			        },
			        labels: {
			            formatter: function () {
			                return Math.abs(this.value);
			            }
			        }
			    },
			    tooltip: {
			        pointFormat: '{point.y}',
	        		shared: true,
			        valueSuffix: '{{$currancy }}'
			    },
			    legend: {
			        enabled: false
			    },
	            series: [{
	                data: [{{$_POST['cs']}},{{$_POST['ps']}},{{$_POST['mvd']}},{{$_POST['mi']}},{{$_POST['ce']}}]
	            }]
	        });
	    });
</script>
@endisset
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>