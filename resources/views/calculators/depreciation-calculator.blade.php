<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="col-12  mx-auto mt-2 w-full lg:w-[70%] md:w-[70%]">
           <input type="hidden" name="hiddent_currency" value="{{ $currancy }}" id="hiddent_currency">
           <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
               <div class="lg:w-1/3 w-full px-2 py-1">
                   <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                       <a href="{{ url('depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5 test11"> {{$lang['simple']}}</a>
                   </div>
               </div>
               <div class="lg:w-1/3 w-full px-2 py-1">
                   <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
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
                <label for="method" class="font-s-14 text-blue">{{ $lang['dep_m'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select class="input" name="method" id="method">
                        <option value="Straight"
                            {{ isset($_POST['method']) && $_POST['method'] == 'Straight' ? 'selected' : '' }} >
                            {{ $lang['s_l'] }}</option>
                        <option value="Declining"
                            {{ isset($_POST['method']) && $_POST['method'] == 'Declining' ? 'selected' : '' }}>
                            {{ $lang['d_b'] }}</option>
                        <option value="sum" {{ isset($_POST['method']) && $_POST['method'] == 'sum' ? 'selected' : '' }}>
                            {{ $lang['sum'] }}</option>
                        {{-- <option value="Reducing"
                            {{ isset($_POST['method']) && $_POST['method'] == 'Reducing' ? 'selected' : '' }}>
                            {{ $lang['red'] }}</option> --}}
                        <option value="unit_of_pro"
                            {{ isset($_POST['method']) && $_POST['method'] == 'unit_of_pro' ? 'selected' : '' }}>
                            {{ $lang['u_of_p'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="asset" class="font-s-14 text-blue">{{ $lang['a_s'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" class="input" name="asset" id="asset"
                        value="{{ isset($_POST['asset']) ? $_POST['asset'] : '15000' }}" placeholder="00">
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="salvage" class="font-s-14 text-blue salvage">{{ $lang['s_v'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" class="input" name="salvage" id="salvage"
                        value="{{ isset($_POST['salvage']) ? $_POST['salvage'] : '2500' }}" placeholder="00">
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="year" class="font-s-14 text-blue year">{{ $lang['d_y'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" class="input" name="year" id="year"
                        value="{{ isset($_POST['year']) ? $_POST['year'] : '5' }}" placeholder="00">
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 {{isset(request()->method) && request()->method == "unit_of_pro" ? 'd-block' : 'hidden'}} unit_of_selet">
                <label for="u_of_p" class="font-s-14 text-blue">{{ $lang['u_of_p'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" class="input" name="u_of_p" id="u_of_p"
                        value="{{ isset($_POST['u_of_p']) ? $_POST['u_of_p'] : '1200' }}" placeholder="00">
                </div>
            </div>
            <div class="col-span-12  {{isset(request()->method) && request()->method == "unit_of_pro" ? 'hidden' : 'row'}} unit_no_selet">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="year" class="font-s-14 text-blue">{{ $lang['r_d'] }}:</label>
                    <div class="w-100 py-2 relative text-center d-flex justify-content-between">
                        @if (isset($error))
                            @if ($_POST['round'] == 'yes')
                                <input type="hidden" name="round" id="round" value="yes">
                                <div class="col-5 py-2 tagsUnit cursor-pointer radius-5 yes_no bg-white border "
                                    id="yes" onclick="change_tab_yes(this)">
                                    {{ $lang['Yes'] }}
                                </div>
                                <div class="col-5 py-2  cursor-pointer radius-5 pro_free_yes_no bg-white border "
                                    id="no" onclick="change_tab_no(this)">
                                    {{ $lang['No'] }}
                                </div>
                            @else
                                <input type="hidden" name="round" id="round" value="no">
                                <div class="col-5 py-2  cursor-pointer radius-5 yes_no bg-white border " id="yes"
                                    onclick="change_tab_yes(this)">
                                    {{ $lang['Yes'] }}
                                </div>
                                <div class="col-5 py-2 tagsUnit  cursor-pointer radius-5 pro_free_yes_no bg-white border "
                                    id="no" onclick="change_tab_no(this)">
                                    {{ $lang['No'] }}
                                </div>
                            @endif
                        @else
                            @isset($detail)
                                @if ($_POST['round'] == 'yes')
                                    <input type="hidden" name="round" id="round" value="yes">
                                    <div class="col-5 py-2 tagsUnit cursor-pointer radius-5 yes_no bg-white border "
                                        id="yes" onclick="change_tab_yes(this)">
                                        {{ $lang['Yes'] }}
                                    </div>
                                    <div class="col-5 py-2  cursor-pointer radius-5 pro_free_yes_no bg-white border "
                                        id="no" onclick="change_tab_no(this)">
                                        {{ $lang['No'] }}
                                    </div>
                                @else
                                    <input type="hidden" name="round" id="round" value="no">
                                    <div class="col-5 py-2  cursor-pointer radius-5 yes_no bg-white border " id="yes"
                                        onclick="change_tab_yes(this)">
                                        {{ $lang['Yes'] }}
                                    </div>
                                    <div class="col-5 py-2 tagsUnit  cursor-pointer radius-5 pro_free_yes_no bg-white border "
                                        id="no" onclick="change_tab_no(this)">
                                        {{ $lang['No'] }}
                                    </div>
                                @endif
                            @else
                                <input type="hidden" name="round" id="round" value="yes">
                                <div class="col-5 py-2 tagsUnit cursor-pointer radius-5 yes_no bg-white border "
                                    id="yes" onclick="change_tab_yes(this)">
                                    {{ $lang['Yes'] }}
                                </div>
                                <div class="col-5 py-2   cursor-pointer radius-5 pro_free_yes_no bg-white border "
                                    id="no" onclick="change_tab_no(this)">
                                    {{ $lang['No'] }}
                                </div>
                            @endisset
                        @endif
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="conver" class="font-s-14 text-blue">{{ $lang['con'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <select class="input" name="conver" id="conver">
                            <option value="3" {{ isset($_POST['conver']) && $_POST['conver'] == '3' ? 'selected' : '' }}>
                                {{ $lang['m_m'] }}</option>
                            <option value="4" {{ isset($_POST['conver']) && $_POST['conver'] == '4' ? 'selected' : '' }}>
                                {{ $lang['f_m'] }}</option>
                            <option value="1" {{ isset($_POST['conver']) && $_POST['conver'] == '1' ? 'selected' : '' }}>
                                {{ $lang['m_q'] }}</option>
                            <option value="2" {{ isset($_POST['conver']) && $_POST['conver'] == '2' ? 'selected' : '' }}>
                                {{ $lang['h_y'] }}</option>
                            <option value="0" {{ isset($_POST['conver']) && $_POST['conver'] == '0' ? 'selected' : '' }}>
                                {{ $lang['f_y'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="date" class="font-s-14 text-blue">{{ $lang['start_d'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="date" class="input" name="date" id="date"
                            value="{{ isset($_POST['date']) ? $_POST['date'] : date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden Factor">
                    <label for="Factor" class="font-s-14 text-blue">{{ $lang['d_f'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="text" step="any" class="input" name="Factor" id="Factor"
                            value="{{ isset($_POST['Factor']) ? $_POST['Factor'] : '4' }}" placeholder="00">
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
                        @if(request()->method == 'unit_of_pro')
                            <div class="w-full md:w-[60%] lg:w-[60%] ">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2">{{$lang['3']}} :</td>
                                        <td class="border-b py-2">{{$currancy." ".$detail['Depreciable_Base']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['1']}} :</td>
                                        <td class="border-b py-2">{{$currancy." ".$detail['Depreciation_Per_Unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['2']}} :</td>
                                        <td class="border-b py-2">{{$currancy." ".$detail['Depreciation_for_Period']}}</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full text-[14px] text-center">
                                    <thead>
                                        <tr id="first_roow">
                                            <td class="py-2 border-b" width="10%"><b>{{ $lang['Year'] }}</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['bb_v'] }}</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['depp'] }}</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['d_a'] }}</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['a_d_a'] }}</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['eb_v'] }}</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! $detail['table'] !!}
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-full mt-4">
                                <div id="container" style="width:100%; height:450px;"></div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>

@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        @if (isset($detail))
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Book Value Vs Depreciation Amount'
                },
                xAxis: {
                    categories: [{{$detail['total_years']}}],
                    crosshair: true,
                    accessibility: {
                        description: 'e'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: 'Book Value',
                        data: [{{$detail['book_des']}}]
                    },
                    {
                        name: '{{ $lang['d_a'] }}',
                        data: [{{$detail['des']}}]
                    }
                ]
            });
        @endif
        @if (isset($detail))
            var method = "{{ $_POST['method'] }}";
            if (method === 'Declining') {
                document.querySelectorAll('.Factor').forEach(function(element) {
                    element.style.display = 'block';
                });
            } else {
                document.querySelectorAll('.Factor').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
            if (method === 'Reducing') {
                document.querySelectorAll('.sal_percent').forEach(function(element) {
                    element.textContent = '%';
                });
                document.querySelectorAll('.salvage').forEach(function(element) {
                    element.textContent = '<?= $lang['a_d_r'] ?>';
                });
            } else {
                document.querySelectorAll('.sal_percent').forEach(function(element) {
                    element.textContent = '$';
                });
                document.querySelectorAll('.salvage').forEach(function(element) {
                    element.textContent = '<?= $lang['s_v'] ?>';
                });
            }
            if(method === 'unit_of_pro'){
                document.querySelectorAll('.unit_of_selet').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.unit_no_selet').forEach(function(element) {
                    element.classList.add('hidden')
                    element.classList.remove('row')
                });
                document.querySelector('.year').innerHTML = '{{$lang['useful']}}';
            }else{
                document.querySelectorAll('.unit_of_selet').forEach(function(element) {
                    element.style.display = 'none';
                });
                document.querySelectorAll('.unit_no_selet').forEach(function(element) {
                    element.classList.add('row')
                    element.classList.remove('hidden')
                });
                document.querySelector('.year').innerHTML = '{{$lang['d_y']}}';
            }
        @endif
        @if (isset($error))
            var method = "{{ $_POST['method'] }}";

            if (method === 'Declining') {
                document.querySelectorAll('.Factor').forEach(function(element) {
                    element.style.display = 'block';
                });
            } else {
                document.querySelectorAll('.Factor').forEach(function(element) {
                    element.style.display = 'none';
                });
            }

            if (method === 'Reducing') {
                document.querySelectorAll('.sal_percent').forEach(function(element) {
                    element.textContent = '%';
                });
                document.querySelectorAll('.salvage').forEach(function(element) {
                    element.textContent = '<?= $lang['a_d_r'] ?>';
                });
                
            } else {
                document.querySelectorAll('.sal_percent').forEach(function(element) {
                    element.textContent = '$';
                });
                document.querySelectorAll('.salvage').forEach(function(element) {
                    element.textContent = '<?= $lang['s_v'] ?>';
                });
                
            }

            if(method === 'unit_of_pro'){
                document.querySelectorAll('.unit_of_selet').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.unit_no_selet').forEach(function(element) {
                    element.classList.add('hidden')
                    element.classList.remove('row')
                });
                document.querySelector('.year').innerHTML = '{{$lang['useful']}}';
            }else{
                document.querySelectorAll('.unit_of_selet').forEach(function(element) {
                    element.style.display = 'none';
                });
                document.querySelectorAll('.unit_no_selet').forEach(function(element) {
                    element.classList.add('row')
                    element.classList.remove('hidden')
                });
                document.querySelector('.year').innerHTML = '{{$lang['d_y']}}';
            }
        @endif

        document.getElementById('method').addEventListener('change', function() {
            var method = document.getElementById('method').value;
            console.log(method);
            if (method === 'Declining') {
                document.querySelectorAll('.Factor').forEach(function(element) {
                    element.style.display = 'block';
                });
            } else {
                document.querySelectorAll('.Factor').forEach(function(element) {
                    element.style.display = 'none';
                });
                
            }
            if(method === 'unit_of_pro'){
                document.querySelectorAll('.unit_of_selet').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.unit_no_selet').forEach(function(element) {
                    element.classList.add('hidden')
                    element.classList.remove('row')
                });
                document.querySelector('.year').innerHTML = '{{$lang['useful']}}';
            }else{
                document.querySelectorAll('.unit_of_selet').forEach(function(element) {
                    element.style.display = 'none';
                });
                document.querySelectorAll('.unit_no_selet').forEach(function(element) {
                    element.classList.add('row')
                    element.classList.remove('hidden')
                });
                document.querySelector('.year').innerHTML = '{{$lang['d_y']}}';
            }
            if (method === 'Reducing') {
                document.querySelectorAll('.sal_percent').forEach(function(element) {
                    element.textContent = '%';
                });
                document.querySelectorAll('.salvage').forEach(function(element) {
                    element.textContent = '<?= $lang['a_d_r'] ?>';
                });
            } else {
                document.querySelectorAll('.sal_percent').forEach(function(element) {
                    element.textContent = '$';
                });
                document.querySelectorAll('.salvage').forEach(function(element) {
                    element.textContent = '<?= $lang['s_v'] ?>';
                });
            }
        });

        function change_tab_yes(element) {
            element.classList.add('yes_no');
            document.getElementById('no').classList.remove('yes_no');
            document.getElementById('round').value = 'yes';

            element.classList.add('tagsUnit');
            document.getElementById('no').classList.remove('tagsUnit');
        }

        function change_tab_no(element) {
            element.classList.add('yes_no');
            document.getElementById('yes').classList.remove('yes_no');
            document.getElementById('round').value = 'no';

            element.classList.add('tagsUnit');
            document.getElementById('yes').classList.remove('tagsUnit');
        }
    </script>
@endpush
