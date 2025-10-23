<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="col-12  mx-auto mt-2 w-full lg:w-[70%] md:w-[70%]">
           <input type="hidden" name="hiddent_currency" value="{{$currancy }}" id="hiddent_currency">
           <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
               <div class="lg:w-1/3 w-full px-2 py-1">
                   <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial" id="imperial">
                       <a href="{{ url('depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5 test11"> {{$lang['simple']}}</a>
                   </div>
               </div>
               <div class="lg:w-1/3 w-full px-2 py-1">
                   <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 tagsUnit  hover_tags hover:text-white metric" id="metric">
                       <a href="{{ url('car-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5 test12"> {{$lang['Auto']}}</a>
                   </div>
               </div>
               <div class="lg:w-1/3 w-full px-2 py-1">
                   <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                       <a href="{{ url('property-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2 cursor-pointer radius-5 test13"> {{$lang['Property']}}</a>
                   </div>
               </div>
           </div>
       </div>
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="car_cost" class="font-s-14 text-blue">{{ $lang['car_p'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" class="input" name="car_cost" id="car_cost" value="{{ isset($_POST['car_cost'])?$_POST['car_cost']:'21000' }}" placeholder="00">
                    <span class="text-blue input_unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="c_age" class="font-s-14 text-blue">{{ $lang['c_age'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" class="input" name="c_age" id="c_age" value="{{ isset($_POST['c_age'])?$_POST['c_age']:'5' }}" placeholder="00">
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="car_year" class="font-s-14 text-blue">{{ $lang['car_year'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" class="input" name="car_year" id="car_year" value="{{ isset($_POST['car_year'])?$_POST['car_year']:'4' }}" placeholder="00">
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="rate_level" class="font-s-14 text-blue">{{ $lang['d_r'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="rate_level" id="rate_level">
                        <option value="1"  {{ isset($_POST['rate_level']) && $_POST['rate_level']=='1'?'selected':''}}> {{$lang['High']}}</option>
                        <option value="2"  {{ isset($_POST['rate_level']) && $_POST['rate_level']=='2'?'selected':''}}> {{$lang['Average']}}</option>
                        <option value="3"  {{ isset($_POST['rate_level']) && $_POST['rate_level']=='3'?'selected':''}} selected> {{$lang['Low']}}</option>
                    </select>
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
                    <div class="w-full mt-2">
                        <table class="w-full text-[18px]">
                            <thead>
                                <tr id="first_roow">
                                    <td class="py-2 border-b"><b>{{$lang['Year']}}</b></td>
                                    <td class="py-2 border-b"><b>{{$lang['bb_v']}}</b></td>
                                    <td class="py-2 border-b"><b>{{$lang['depp']}}</b></td>
                                    <td class="py-2 border-b"><b>{{$lang['d_a']}}</b></td>
                                    <td class="py-2 border-b"><b>{{$lang['a_d_a']}}</b></td>
                                    <td class="py-2 border-b"><b>{{$lang['eb_v']}}</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                {!! $detail['table'] !!}
                            </tbody>
                        </table>
                  </div>
                    <div class="w-full mt-3">
                        <div id="container" style="width:100%; height:450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
 @if(isset($detail))
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
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
                      text: '{{$lang['r_v']}}'
                  },
              },
              xAxis: {
                  title: {
                      text: '{{$lang['Year']}}'
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
                  valueSuffix: '{{$currancy }}'
              },
              series: [{
                  name: '{{$lang['eb_v']}}',
                  data: [{{$detail['total_book_value']}}]
              }]
          });
      });
    </script>
    @endif
@endpush