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
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300   hover_tags hover:text-white metric" id="metric">
                    <a href="{{ url('car-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5 test12"> {{$lang['Auto']}}</a>
                </div>
            </div>
            <div class="lg:w-1/3 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags tagsUnit hover:text-white metric" id="metric">
                    <a href="{{ url('property-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2 cursor-pointer radius-5 test13"> {{$lang['Property']}}</a>
                </div>
            </div>
        </div>
    </div>
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="basis" class="font-s-14 text-blue">{{ $lang['b_c'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" class="input" name="basis" id="basis" value="{{ isset($_POST['basis'])?$_POST['basis']:'21000' }}" placeholder="00">
                    <span class="text-blue input_unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="recovery" class="font-s-14 text-blue">{{ $lang['r_p_y'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" class="input" name="recovery" id="recovery" value="{{ isset($_POST['recovery'])?$_POST['recovery']:'5' }}" placeholder="00">
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="round" class="font-s-14 text-blue">{{ $lang['r_d'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="round" id="round">
                        <option value="yes"  {{ isset($_POST['round']) && $_POST['round']=='yes'?'selected':''}}> {{$lang['Yes']}}</option>
                        <option value="No"  {{ isset($_POST['round']) && $_POST['round']=='No'?'selected':''}}> {{$lang['No']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="date1" class="font-s-14 text-blue">{{ $lang['start_d'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="date"  class="input" name="date1" id="date1" value="{{ isset($_POST['date1']) ? $_POST['date1'] : date('Y-m-d') }}" placeholder="00">
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
                        <div class="col-lg-12 mt-2 overflow-auto">
                            <table class="w-full text-[14px]">
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
                        <div class="col-12 mt-3">
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