<style>
    .canvasjs-chart-credit{
        display: none
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="gender" id="gender" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['3'],$lang['4']];
                                $val=["male","female"];
                                optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height_ft" class="label">{{ $lang['5'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'5' }}" />
                    </div>
                </div>

                                  
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'm')">meters (m)</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                    <label for="height_cm" class="label">{{ $lang['5'] }} <span class="text-blue height_unit">(cm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="stoft/inne" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm')">meters (m)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="label">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'stone')">stone</p>
                        </div>
                    </div>
                </div>
              
                
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="activity" class="label">PAL (optional):</label>
                    <div class="w-full py-2 position-relative">
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = [$lang['12'],$lang['13'],$lang['14'],$lang['15'],$lang['16'],$lang['17']];
                                $val=["1.2","1.375","1.55","1.725","1.9","2.3"];
                                optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'1.55');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <span>{{ $lang[7] }}:</span>
                    <span><a class="text-blue-500 text-[14px] text-decoration-none" href="{{ url('bmr-calculator') }}/" target="_blank" rel="noopener">BMR Calculator</a></span>,
                    <span><a class="text-blue-500 text-[14px] text-decoration-none" href="{{ url('macro-calculator') }}/" target="_blank" rel="noopener">Macro Calculator</a></span>,
                    <span><a class="text-blue-500 text-[14px] text-decoration-none" href="{{ url('weightloss-calculator') }}/" target="_blank" rel="noopener">Weight loss Calculator</a></span>
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
                        <div class="w-full">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>BMR = <span class="text-[#119154] text-[28px]">{{ $detail['bmr_ans'] }}</span> kcal/day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[8] }} = <span class="text-[#119154] text-[28px]">{{ $detail['tee'] }}</span> kcal/day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[9] }} = <span class="text-[#119154] text-[28px]">{{ $detail['carb_gram_ans'] }}</span> Grams per day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[10] }} = <span class="text-[#119154] text-[28px]">{{ $detail['pro_gram_ans'] }}</span> Grams per day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[11] }} = <span class="text-[#119154] text-[28px]">{{ $detail['fats_gram_ans'] }}</span> Grams per day</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12">
                                <p class="font-s-20 mb-2"><strong class="text-blue">Grams Per Day Percentage Chart</strong></p>
                                <div class="col-lg-6" id="chartContainer" style="height: 200px"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <script>
                window.onload = function () {
                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        backgroundColor: "transparent",
                        legend:{
                            cursor: "pointer",
                            itemclick: explodePie,
                            fontSize: 14
                        },
                        data: [{
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{name}: <strong>{y}%</strong>",
                            // indexLabel: "{name} - {y}%",
                            dataPoints: [
                                { y: {{ $detail['carb_per'] }}, name: "Carbohydrates" },
                                { y: {{ $detail['pro_per'] }}, name: "Protein" },
                                { y: {{ $detail['fats_per'] }}, name: "Fat"}
                            ]
                        }]
                    });
                    chart.render();
                }

                function explodePie (e) {
                    if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                        e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                    } else {
                        e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                    }
                    e.chart.render();
                }
            </script>
        @endisset
        <script>
            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit').textContent = '('+val+')';
                        document.getElementById('height_cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            @if(isset($detail) || isset($error))
                var val = document.getElementById('unit_ft_in').value;
                if (val === 'ft/in') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                    document.querySelector('.height_unit').textContent = '('+val+')';
                    document.getElementById('height_cm').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>