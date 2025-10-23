@php
    if ( isset( $_POST[ 'submit' ] ) ) {
        $main_unit = trim( $_POST[ 'main_unit' ] );
        $price = trim( $_POST[ 'price' ] );
    } elseif ( isset( $_GET[ 'res_link' ] ) ) {
        $main_unit = trim( $_GET[ 'main_unit' ] );
        $price = trim( $_GET[ 'price' ] );
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="main_unit" class="label cat">{{ $lang['20'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" name="main_unit" id="main_unit" aria-label="input select">                        
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['23'],$lang['24']];
                            $val = [$lang['23'],$lang['24']];
                            optionsList($val,$name,isset($_POST['main_unit'])?$_POST['main_unit']:'Full Capacity Charging Cost');
                        @endphp
                    </select>
                </div>
            </div> 
            <div class="col-span-12 cost {{ isset($_POST['main_unit']) && $_POST['main_unit'] !== 'Full Capacity Charging Cost' ? 'hidden' : 'd-block' }}">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="battery" class="label">{{ $lang['21'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="battery" id="battery" class="input" aria-label="input"  value="{{ isset($_POST['battery'])?$_POST['battery']:'3' }}" />
                        <span class="input_unit">kWh</span>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="electricity" class="label">{{ $lang['22'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="electricity" id="electricity" class="input" aria-label="input"  value="{{ isset($_POST['electricity'])?$_POST['electricity']:'4' }}" />
                        <span class="input_unit">per kWh</span>
                    </div>
                </div>
            </div>
            <div class="col-span-12 c_cost {{ isset($_POST['main_unit']) && $_POST['main_unit'] !== 'Full Capacity Charging Cost' ? 'd-block' : 'hidden' }}">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="type" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 relative">
                        <select id="type" name="type" class="input">
                            @php
                                $name = ["Tesla Model S (2013 - 60D)", "Tesla Model S (2016 - 60D)", "Tesla Model S (2017 - 100D)", "Tesla Model 3 (2019)", "Tesla Model 3 (2021)", "Tesla Model X (2016 - 90D)", "Tesla Model X (2016 - P100D)", "Tesla Model Y (2021)", "Chevrolet Bolt (2016)", "Audi Q4 e-tron 50 quattro", "Nissan Leaf", "Hyundai IONIQ Electric", "Citroen e-C4", "Kia EV6", "Kia Soul EV", "BMW i3", "BMW i4", "Fiat 500e", "Hyundai Kona Electric"];
                                $val = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19"];
                                optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'Tesla Model S (2013 - 60D)');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="price" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="price" id="price" class="input" aria-label="input"  value="{{ isset($_POST['price'])?$_POST['price']:'4' }}" />
                        <span class="input_unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="distance" class="label">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units_dropdown')">{{ isset($_POST['units'])?$_POST['units']:'km' }} ▾</label>
                        <input type="text" name="units" value="{{ isset($_POST['units'])?$_POST['units']:'km' }}" id="units" class="hidden">
                        <div id="units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'mi')">mi</p>
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
                        <div class="w-full my-2">
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['4']}} :</strong></td>
                                        <td class="border-b py-2">{{$currancy}} {{$detail['cost']}}</td>
                                    </tr>
                                    @if($main_unit == 'Custom Distance Charging Cost')
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['6']}} {{ $lang['4']}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy}} {{round($detail['ec'])}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            @if($main_unit == 'Custom Distance Charging Cost')
                                <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                    <p class="text-[20px] mt-3"><strong>{{ $lang['7'] }}</strong></p>
                                    <table class="w-full font-s-18 mt-2">
                                        <thead>
                                            <tr id="first_roow">
                                                <td class="border-b py-2">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['name'] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['9'] }} {{ $lang['10'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['capacity'] }} {{ $lang['11'] }} </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['9'] }} {{ $lang['12'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['capacity'] * 1000 }} {{ $lang['13'] }} </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['15'] }} :</td>
                                                <td class="border-b py-2">{{ round($detail['efficiency'], 2) }} {{ $lang['16'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['17'] }} :</td>
                                                <td class="border-b py-2">{{ round(($detail['efficiency'] * 1.61), 1) }} {{ $lang['18'] }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <div class="w-full bg-white p-4 rounded-lg mt-4">
                                <div class="col-4 my-3">
                                        <p class="padding_5">
                                            <strong>
                                            {{$lang['19']}}:
                                            </strong>
                                        </p>
                                        <select id="select-list" class="input mt-3">
                                            <option value="5">5 %</option>
                                            <option value="10">10 %</option>
                                            <option value="20">20 %</option>
                                            <option value="50">50 %</option>
                                        </select>
                                </div>
                                <div id="chart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        @push('calculatorJS')
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
            <script>
                function draw_chart(main_val, x_array) {    
                    var options = {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'Charging cost vs Battery level'
                        },
                        xAxis: {
                            categories: x_array,
                        },
                        yAxis: {
                            title: {
                                text: ''
                            }
                        },
                        series: [{
                            name: 'Cost',
        
                        }]
                    };
                    var newData = [];	
                    for (let i = 0; i <= 100; i = i + main_val) {
                        newData.push({{$detail['cost']}} * (i / 100))
                    }
                    options.series[0].data = newData;
        
                    // render the chart
                    Highcharts.chart('chart-container', options);
                }
    
                let x_array = ['0','5', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60', '65', '70', '75', '80', '85', '90', '95', '100'];
                draw_chart(5, x_array);
                document.getElementById("select-list").addEventListener('change', function () {
                    var drop_val = this.value;
                    if (drop_val == 5) {
                        let x_array = ['0','5', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60', '65', '70', '75', '80', '85', '90', '95', '100'];
                        draw_chart(5, x_array);
                    }else if (drop_val == 10) {
                        let x_array = ['0','10', '20', '30', '40', '50', '60', '70', '80', '90', '100'];
                        draw_chart(10, x_array);
                    }else if (drop_val == 20) {
                        let x_array = ['0','20', '40', '60', '80', '100'];
                        draw_chart(20, x_array);
                    }else if (drop_val == 50) {
                        let x_array = ['0','50','100'];
                        draw_chart(50, x_array);
                    }
                });
                
            </script>
        @endpush
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('main_unit').addEventListener('change', function() {
            var to_cal = this.value;
            var cost = document.querySelector('.cost');
            var cost2 = document.querySelector('.c_cost');
            if (to_cal == 'Full Capacity Charging Cost') {
                cost.classList.add('d-block');
                cost.classList.remove('hidden');
                cost2.classList.add('hidden');
            } else {
                cost2.classList.add('d-block');
                cost2.classList.remove('hidden');
                cost.classList.add('hidden');
            }
        });
    </script>
@endpush