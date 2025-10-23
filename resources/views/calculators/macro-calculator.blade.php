<style>
.first:before {
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
    @unless(isset($detail))


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
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
                                $name = [$lang['male'],$lang['female']];
                                $val = ["Male","Female"];
                                optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-2 lg:col-span-2 ft_in">
                    <label for="height-ft" class="label">{!! $lang['height'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="height-ft" id="height-ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height-ft'])?$_POST['height-ft']:'5' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-4 lg:col-span-4 ft_in">
                    <label for="height-in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height-in" id="height-in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-in']) ? $_POST['height-in'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                    <label for="height-cm" class="label">{{ $lang['height'] }} (cm):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height-cm" id="height-cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm']) ? $_POST['height-cm'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '158' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">kilograms (kg)</p>
                        </div>
                     </div>
                </div>
             
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="meal" class="label">{!! $lang['meal'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="meal" id="meal" class="input">
                            @php
                                $name = [$lang['all'],"3","4","5"];
                                $val = ["all","3","4","5"];
                                optionsList($val,$name,isset($_POST['meal'])?$_POST['meal']:'all');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="goal" class="label">{!! $lang['Your_goal'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="goal" id="goal" class="input">
                            @php
                                $name = [$lang['main'],$lang['loss_20'],$lang['loss_10'],$lang['gain']];
                                $val = ["Maintain","Fat Loss","Loss 10%","Muscle Gain"];
                                optionsList($val,$name,isset($_POST['goal'])?$_POST['goal']:'Maintain');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="activity" class="label">{!! $lang['activity'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = [$lang['a1'],$lang['a2'],$lang['a3'],$lang['a4'],$lang['a5']];
                                $val = ["Sedentary","Lightly Active","Moderately Active","Very Active","Extremely Active"];
                                optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'Sedentary');
                            @endphp
                        </select>
                    </div>
                </div>
               
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="formula" class="label">{!! $lang['formula'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="formula" id="formula" class="input">
                            @php
                                $name = [$lang['9'],$lang['10'],$lang['11']];
                                $val = ["2nd","first","3rd"];
                                optionsList($val,$name,isset($_POST['formula'])?$_POST['formula']:'2nd');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 percent hidden">
                    <label for="percent" class="label">
                        {{ $lang['b_f'] }}
                        <a title="Body Fat Percentage Calculator" href="{{ url('body-fat-percentage-calculator') }}/" class="text-blue font-s-12" target="_blank" rel="noopener"> {{ $lang['click'] }}</a>:
                    </label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="percent" id="percent" class="input" aria-label="input" placeholder="0%" value="{{ isset($_POST['percent'])?$_POST['percent']:'' }}" />
                        <span class="text-blue input_unit">%</span>
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

    @endunless
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  p-3 rounded-lg mt-3">
                    <div class="w-full">
                        <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 tabs">
                                <div class="lg:w-1/5 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit balanced" id="balanced">
                                            {{ $lang['bal'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/5 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white low_fat" id="low_fat">
                                            {{ $lang['low_fat'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/5 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white low_carb" id="low_carb">
                                            {{ $lang['low_carb'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/5 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white high_pro" id="high_pro">
                                            {{ $lang['high_pro'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/5 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white own" id="own">
                                            {{ $lang['own'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="w-full hidden create_own">
                            <div class="grid grid-cols-12  gap-2 mt-3">
                                <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                    <fieldset class="rounded-[10px] ">
                                        <legend class="text-blue-700 px-1">{{ $lang['PROTEIN'] }}</legend>
                                        <input type="range" min="10" max="35" class="w-100 own_pro">
                                    </fieldset>
                                </div>
                                <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                    <fieldset class="rounded-[10px] ">
                                        <legend class="text-blue-700 px-1">{{ $lang['FAT'] }}</legend>
                                        <input type="range" min="20" max="35" class="w-100 own_fat">
                                    </fieldset>
                                </div>
                                <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                    <fieldset class="rounded-[10px] ">
                                        <legend class="text-blue-700 px-1">{{ $lang['CARBS'] }}</legend>
                                        <input type="range" min="45" max="65" class="w-100 own_carb">
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="w-full mt-3 mb-1">{{ $lang['before_res'] }}</p>
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-9 lg:col-span-9">
                                    <div class="flex flex-wrap items-center justify-between relative bg-[#F6FAFC] border rounded px-3 pb-2 mt-3" style="border: 1px solid #c1b8b899;">
                                        <div class="flex items-center px-3 px-lg-0 mt-2">
                                            <img src="{{ url('images/calories1.png') }}" alt="Calories" width="60px" height="60px">
                                            <strong class="text-blue font-s-18 ms-2">{{ $lang['CALORIES'] }}</strong>
                                        </div>
                                        <div class="px-3 px-lg-0 mt-2 d-lg">
                                            <div class="text-[32px]"><strong style="color:#908310">
                                                @if ($detail['calories']!='')
                                                    {{ $detail['calories'] }}
                                                @else
                                                    0
                                                @endif
                                            </strong></div>
                                            <div>
                                                @if ($_POST['meal']=='all')
                                                    {{ $lang['C_per_day'] }}
                                                @else
                                                    {{ $lang['cpm'] }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="overflow-auto px-3 px-lg-0 mt-2">
                                            <table class="w-full text-[14px]" cellspacing="0">
                                                <tr>
                                                    <td class="border-b-dark first py-2" style="color: rgb(22,111,165);">{{ $lang['PROTEIN'] }}</td>
                                                    <td class="border-b-dark pro_per ps-5">20%</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b-dark first py-2" style="color: rgb(41,159,206);">{{ $lang['FAT'] }}</td>
                                                    <td class="border-b-dark fat_per ps-5">30%</td>
                                                </tr>
                                                <tr>
                                                    <td class="first py-2" style="color: rgb(100,211,255);">{{ $lang['CARBS'] }}</td>
                                                    <td class="carb_per ps-5">50%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <div id="piechart" class="bg-white border rounded-full  overflow-hidden" style="{{ ($device === 'desktop') ? 'width:150px;height:150px' : 'width:200px;height:200px' }}"></div>
                                </div>
                            </div>
                            <p class="mt-2">{{ $lang['after_res'] }}</p>
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/protein1.png') }}" alt="Protien" width="60px" height="60px">
                                            <div class="ms-2"><strong class="text-blue font-s-20">{{ $lang['PROTEIN'] }}</strong></div>
                                        </div>
                                        <div>
                                            <div class=""><strong class="text-blue font-s-22 protein">
                                                @if ($detail['calories']!='')
                                                    {{ round(($detail['calories'] * 0.20) / 4) }}
                                                @else
                                                    0
                                                @endif
                                            </strong></div>
                                            <div class="font-s-12">
                                                @if ($_POST['meal']=='all')
                                                    {{ $lang['grams_per_day'] }}
                                                @else
                                                    {{ $lang['gpm'] }}
                                                @endif
                                            </div>
                                            <div class="font-s-12 text-gray">{{ $lang['range'] }} {{ round(($detail['calories'] * 0.10) / 4).' - '.round(($detail['calories'] * 0.35) / 4) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/Fats.png') }}" alt="Fat" width="60px" height="60px">
                                            <div class="ms-2"><strong class="text-blue font-s-20">{{ $lang['FAT'] }}</strong></div>
                                        </div>
                                        <div>
                                            <div class=""><strong class="text-blue font-s-22 fats">
                                                @if ($detail['calories']!='')
                                                    {{ round(($detail['calories'] * 0.30) / 9) }}
                                                @else
                                                    0
                                                @endif
                                            </strong></div>
                                            <div class="font-s-12">
                                                @if ($_POST['meal']=='all')
                                                    {{ $lang['grams_per_day'] }}
                                                @else
                                                    {{ $lang['gpm'] }}
                                                @endif
                                            </div>
                                            <div class="font-s-12 text-gray">{{ $lang['range'] }} {{ round(($detail['calories'] * 0.20) / 9).' - '.round(($detail['calories'] * 0.35) / 9) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/Carbs1.png') }}" alt="Carbs" width="60px" height="60px">
                                            <div class="ms-2"><strong class="text-blue font-s-20">{{ $lang['CARBS'] }}</strong></div>
                                        </div>
                                        <div>
                                            <div class=""><strong class="text-blue font-s-22 carbs">
                                                @if ($detail['calories']!='')
                                                    {{ round(($detail['calories'] * 0.50) / 4) }}
                                                @else
                                                    0
                                                @endif
                                            </strong></div>
                                            <div class="font-s-12">
                                                @if ($_POST['meal']=='all')
                                                    {{ $lang['grams_per_day'] }}
                                                @else
                                                    {{ $lang['gpm'] }}
                                                @endif
                                            </div>
                                            <div class="font-s-12 text-gray">{{ $lang['range'] }} {{ round(($detail['calories'] * 0.45) / 4).' - '.round(($detail['calories'] * 0.65) / 4) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/Sugar.png') }}" alt="Sugar" width="60px" height="60px">
                                            <div class="ms-2"><strong class="text-blue font-s-20">{{ $lang['suger'] }}</strong></div>
                                        </div>
                                        <div>
                                            <div class=""><strong class="text-blue font-s-22">
                                                @if ($detail['Sugar']!='')
                                                    {{ $detail['Sugar'] }}
                                                @else
                                                    0
                                                @endif
                                            </strong></div>
                                            <div class="font-s-12">
                                                @if ($_POST['meal']=='all')
                                                    {{ $lang['grams_per_day'] }}
                                                @else
                                                    {{ $lang['gpm'] }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="col-lg-6 px-lg-3 py-2 mx-auto">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/stand_fat.png') }}" alt="Saturated Fat" width="60px" height="60px">
                                                <div class="ms-2"><strong class="text-blue font-s-20">{{ $lang['s_f'] }}</strong></div>
                                            </div>
                                            <div>
                                                <div class=""><strong class="text-blue font-s-22">
                                                    @if ($detail['stand_fat']!='')
                                                        {{ $detail['stand_fat'] }}
                                                    @else
                                                        0
                                                    @endif
                                                </strong></div>
                                                <div class="font-s-12">
                                                    @if ($_POST['meal']=='all')
                                                        {{ $lang['grams_per_day'] }}
                                                    @else
                                                        {{ $lang['gpm'] }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-center mt-[30px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @if(isset($detail))
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Protein', 20],
                        ['Fat', 30],
                        ['Carbs', 50]
                    ]);

                    var options = {
                        backgroundColor: 'transparent',
                        legend: 'none',
                        text: false,
                        slices: {
                            0: { color: '#166FA5' },
                            1: { color: '#299FCE' },
                            2: { color: '#64D3FF' }
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }

                var cal = {{$detail['calories'] }};

                document.querySelectorAll('.low_fat').forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.querySelector('.create_own').style.display = 'none';
                        var pro = Math.round((cal * 0.25) / 4);
                        var fat = Math.round((cal * 0.20) / 9);
                        var carbs = Math.round((cal * 0.55) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = '25%';
                        document.querySelector('.fat_per').textContent = '20%';
                        document.querySelector('.carb_per').textContent = '55%';
                        document.querySelector('.tabs').querySelectorAll('*').forEach(function(child) {
                            child.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', 25],
                                ['Fat', 20],
                                ['Carbs', 55]
                            ]);

                            var options = {
                                backgroundColor: 'transparent',
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.low_carb').forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.querySelector('.create_own').style.display = 'none';
                        var pro = Math.round((cal * 0.25) / 4);
                        var fat = Math.round((cal * 0.30) / 9);
                        var carbs = Math.round((cal * 0.45) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = '25%';
                        document.querySelector('.fat_per').textContent = '30%';
                        document.querySelector('.carb_per').textContent = '45%';
                        document.querySelector('.tabs').querySelectorAll('*').forEach(function(child) {
                            child.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', 25],
                                ['Fat', 30],
                                ['Carbs', 45]
                            ]);

                            var options = {
                                backgroundColor: 'transparent',
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.high_pro').forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.querySelector('.create_own').style.display = 'none';
                        var pro = Math.round((cal * 0.35) / 4);
                        var fat = Math.round((cal * 0.20) / 9);
                        var carbs = Math.round((cal * 0.45) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = '35%';
                        document.querySelector('.fat_per').textContent = '20%';
                        document.querySelector('.carb_per').textContent = '45%';
                        document.querySelector('.tabs').querySelectorAll('*').forEach(function(child) {
                            child.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', 35],
                                ['Fat', 20],
                                ['Carbs', 45]
                            ]);

                            var options = {
                                backgroundColor: 'transparent',
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.balanced').forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.querySelector('.create_own').style.display = 'none';
                        var pro = Math.round((cal * 0.20) / 4);
                        var fat = Math.round((cal * 0.30) / 9);
                        var carbs = Math.round((cal * 0.50) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = '20%';
                        document.querySelector('.fat_per').textContent = '30%';
                        document.querySelector('.carb_per').textContent = '50%';
                        document.querySelector('.tabs').querySelectorAll('*').forEach(function(child) {
                            child.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', 20],
                                ['Fat', 30],
                                ['Carbs', 50]
                            ]);

                            var options = {
                                backgroundColor: 'transparent',
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.own').forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.querySelector('.create_own').style.display = 'block';
                        document.querySelector('.tabs').querySelectorAll('*').forEach(function(child) {
                            child.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                    });
                });
                document.querySelectorAll('.own_pro').forEach(function(element) {
                    element.addEventListener('change', function() {
                        var own_pro = parseInt(this.value);
                        var remain = 100 - own_pro;
                        var own_fat = Math.round(remain / 3);
                        var own_carb = 100 - own_fat - own_pro;
                        if (own_fat > 35) {
                            remain = parseInt(own_fat - 35);
                            own_fat = 35;
                            own_carb += remain;
                        }
                        if (own_carb < 45) {
                            own_carb = 45;
                            remain = parseInt(45 - own_carb);
                            own_fat -= remain;
                        }
                        document.querySelector('.own_fat').value = own_fat;
                        document.querySelector('.own_carb').value = own_carb;
                        var pro = Math.round((cal * (own_pro / 100)) / 4);
                        var fat = Math.round((cal * (own_fat / 100)) / 9);
                        var carbs = Math.round((cal * (own_carb / 100)) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = own_pro + "%";
                        document.querySelector('.fat_per').textContent = own_fat + "%";
                        document.querySelector('.carb_per').textContent = own_carb + "%";
                        own_pro = Number(own_pro);
                        own_fat = Number(own_fat);
                        own_carb = Number(own_carb);
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', own_pro],
                                ['Fat', own_fat],
                                ['Carbs', own_carb]
                            ]);
                            var options = {
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.own_fat').forEach(function(element) {
                    element.addEventListener('change', function() {
                        var own_fat = parseInt(this.value);
                        var remain = 100 - own_fat;
                        var own_pro = Math.round(remain / 3);
                        var own_carb = 100 - own_fat - own_pro;
                        if (own_carb < 45) {
                            remain = 50 - own_carb;
                            own_carb = 50;
                            own_pro -= remain;
                        }
                        document.querySelector('.own_pro').value = own_pro;
                        document.querySelector('.own_carb').value = own_carb;
                        var pro = Math.round((cal * (own_pro / 100)) / 4);
                        var fat = Math.round((cal * (own_fat / 100)) / 9);
                        var carbs = Math.round((cal * (own_carb / 100)) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = own_pro + "%";
                        document.querySelector('.fat_per').textContent = own_fat + "%";
                        document.querySelector('.carb_per').textContent = own_carb + "%";
                        own_pro = Number(own_pro);
                        own_fat = Number(own_fat);
                        own_carb = Number(own_carb);
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', own_pro],
                                ['Fat', own_fat],
                                ['Carbs', own_carb]
                            ]);
                            var options = {
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.own_carb').forEach(function(element) {
                    element.addEventListener('change', function() {
                        var own_carb = parseInt(this.value);
                        var remain = 100 - own_carb;
                        var own_pro = Math.round(remain / 3);
                        var own_fat = 100 - own_carb - own_pro;
                        if (own_fat > 35) {
                            remain = parseInt(own_fat - 30);
                            own_fat = 30;
                            own_pro += remain;
                        }
                        document.querySelector('.own_pro').value = own_pro;
                        document.querySelector('.own_fat').value = own_fat;
                        var pro = Math.round((cal * (own_pro / 100)) / 4);
                        var fat = Math.round((cal * (own_fat / 100)) / 9);
                        var carbs = Math.round((cal * (own_carb / 100)) / 4);
                        document.querySelector('.protein').textContent = pro;
                        document.querySelector('.fats').textContent = fat;
                        document.querySelector('.carbs').textContent = carbs;
                        document.querySelector('.pro_per').textContent = own_pro + "%";
                        document.querySelector('.fat_per').textContent = own_fat + "%";
                        document.querySelector('.carb_per').textContent = own_carb + "%";
                        own_pro = Number(own_pro);
                        own_fat = Number(own_fat);
                        own_carb = Number(own_carb);
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', own_pro],
                                ['Fat', own_fat],
                                ['Carbs', own_carb]
                            ]);
                            var options = {
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#166FA5' },
                                    1: { color: '#299FCE' },
                                    2: { color: '#64D3FF' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    });
                });
            </script>
        @else
            <script>
                @isset($error)
                    let doc_formula = document.getElementById('formula')
                    if(doc_formula){
                        var formula = doc_formula.value;
                        if (formula === '3rd') {
                            document.querySelectorAll('.percent').forEach(function(element) {
                                element.style.display = 'block';
                            });
                        } else {
                            document.querySelectorAll('.percent').forEach(function(element) {
                                element.style.display = 'none';
                            });
                        }
                    }

                    let doc_unit = document.getElementById('unit_ft_in')
                    if(doc_unit){
                        var val = doc_unit.value;
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
                        }
                    }
                @endisset

                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById('formula').addEventListener('change', function() {
                        var formula = this.value;
                        if (formula === '3rd') {
                            document.querySelectorAll('.percent').forEach(function(element) {
                                element.style.display = 'block';
                            });
                        } else {
                            document.querySelectorAll('.percent').forEach(function(element) {
                                element.style.display = 'none';
                            });
                        }
                    });
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
                            }
                            
                            document.getElementById('unit_ft_in').value = val;
                            document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                                elem.classList.toggle('hidden');
                            });
                        });
                    });
                });
            </script>
        @endif
    @endpush
</form>