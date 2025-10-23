<style>
.bg-gradient {
    background: #2845F5;
    padding: 5px;
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

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="text-[14px] text-[#2845F5]">{{ $lang['gender'] }}:</label>
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
                                $name = [$lang['male'],$lang['female'],$lang['pergnant'],$lang['child'],$lang['lac'],"Obese Boy (3-18 Years)","Obese Girl (3-18 Years)"];
                                $val=["Male","Female","pergnant","child","lac","obs_boy","obs_girl"];
                                optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 age">
                    <label for="age" class="text-[14px] text-[#2845F5]">{{ $lang['age_year'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 child hidden">
                    <label for="child_age" class="text-[14px] text-[#2845F5]">{{ $lang['age_m'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="child_age" id="child_age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['child_age'])?$_POST['child_age']:'25' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 trim hidden">
                    <label for="trim" class="text-[14px] text-[#2845F5]">{{ $lang['trim'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="trim" id="trim" class="input">
                            @php
                                $name = [$lang['1st'],$lang['2nd'],$lang['3rd']];
                                $val=["1st","2nd","3rd"];
                                optionsList($val,$name,isset($_POST['trim'])?$_POST['trim']:'1st');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 period hidden">
                    <label for="period" class="text-[14px] text-[#2845F5]">{{ $lang['period'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="period" id="period" class="input">
                            @php
                                $name = [$lang['1st6'],$lang['2nd6']];
                                $val=["1st6","2nd6"];
                                optionsList($val,$name,isset($_POST['period'])?$_POST['period']:'1st6');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 lac hidden">
                    <label for="lac" class="text-[14px] text-[#2845F5]">{{ $lang['lac'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="lac" id="lac" class="input">
                            @php
                                $name = [$lang['1st'],$lang['2nd6']];
                                $val=["1st","2nd6"];
                                optionsList($val,$name,isset($_POST['lac'])?$_POST['lac']:'1st');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in age">
                    <label for="height-ft" class="text-[14px] text-[#2845F5]">{{ $lang['height'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="height-ft" id="height-ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height-ft'])?$_POST['height-ft']:'5' }}" />
                    </div>
                </div>

                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in age">
                    <label for="height-in" class="text-[14px] text-[#2845F5]">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                    <label for="height-cm" class="text-[14px] text-[#2845F5]">{{ $lang['height'] }} (cm):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height-cm" id="height-cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm']) ? $_POST['height-cm'] : '175' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="text-[14px] text-[#2845F5]">{{ $lang['weight'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '160' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-12 md:col-span-6 lg:col-span-6 age">
                    <label for="activity" class="text-[14px] text-[#2845F5]">{{ $lang['activity'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = [$lang['stand'],$lang['light'],$lang['mod'],$lang['very']];
                                $val=["Sedentary","Lightly Active","Moderately Active","Very Active"];
                                optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'Sedentary');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 age">
                    <label for="goal" class="text-[14px] text-[#2845F5]">{{ $lang['goal'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="goal" id="goal" class="input">
                            @php
                                $name = [$lang['maintain'],$lang['lose'],$lang['gain']];
                                $val=["maintain","lose","gain"];
                                optionsList($val,$name,isset($_POST['goal'])?$_POST['goal']:'maintain');
                            @endphp
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
    @endunless
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  mt-3">
                    @if(!isset($detail['EER_child']))
                        <div class="w-full">
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                @if(isset($detail['tee']))
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-4" style="border: 1px solid #c1b8b899;">
                                            <p class="text-center"><strong>Total Energy Expenditure (TEE)</strong></p>
                                            <div class="flex items-center justify-between bg-white rounded-lg p-3 mt-2">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/eer-icon.png') }}" width="50px" height="50px" alt="eer calculator">
                                                    <p class="text-[18px] ms-2"><strong class="text-[#2845F5]">Your TEE</strong></p>
                                                </div>
                                                <div>
                                                    <div class="font-s-25"><strong class="text-[#2845F5]">{{ $detail['tee'] }}</strong></div>
                                                    <div>{{ $lang['Calories/Day'] }}</div>
                                                </div>
                                            </div>
                                            <p class="col s12 mt-2">{{ $lang['obese_c'] }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-4" style="border: 1px solid #c1b8b899;">
                                            <p class="text-center"><strong>{{ $lang['eer'] }}</strong></p>
                                            <div class="flex items-center justify-between bg-white rounded-lg p-3 mt-2">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/eer-icon.png') }}" width="50px" height="50px" alt="eer calculator">
                                                    <p class="text-[18px] ms-2"><strong class="text-[#2845F5]">{{ $lang['your'] }}</strong></p>
                                                </div>
                                                <div>
                                                    <div class="font-s-25"><strong class="text-[#2845F5]">{{ $detail['EER'] }}</strong></div>
                                                    <div>{{ $lang['Calories/Day'] }}</div>
                                                </div>
                                            </div>
                                            @if(isset($detail['ibw']))
                                                <p class="mt-2"><strong>Healthy Weight Range would be:</strong></p>
                                                <p class="font-s-28"><strong class="text-[#2845F5]">{{ $detail['ibw'] }}</strong></p>
                                            @endif
                                            <p class="col s12">{{ $lang['adult'] }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="px-lg-3 py-2 pt-lg-3">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/bmr.png') }}" width="50px" height="50px" alt="bmr">
                                                <p class="text-[18px] ms-2"><strong class="text-[#2845F5] ">BMR</strong></p>
                                            </div>
                                            <div>
                                                @if ($detail['bmr']!='')
                                                    <div class="text-center text-[20px]"><strong class="text-[#2845F5]">{{ $detail['bmr'] }}</strong></div>
                                                    <div class="text-[14px]">{{ $lang['Calories/Day'] }}</div>
                                                @else
                                                    <div class="text-center text-[20px]"><strong class="text-[#2845F5]">00.0</strong></div>
                                                    <div class="text-[14px]">{{ $lang['Calories/Day'] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-lg-3 py-2">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/bmi.png') }}" width="50px" height="50px" alt="bmi">
                                                <p class="text-[18px] ms-2"><strong class="text-[#2845F5] ">BMI</strong></p>
                                            </div>
                                            <div>
                                                @if ($detail['BMI']!='')
                                                    @php
                                                        if($detail['class']=='under'){
                                                            $bmi_class=$lang['under'];
                                                        }elseif ($detail['class']=='health') {
                                                            $bmi_class=$lang['health'];
                                                        }elseif ($detail['class']=='over') {
                                                            $bmi_class=$lang['over'];
                                                        }elseif ($detail['class']=='obese') {
                                                            $bmi_class=$lang['obese'];
                                                        }elseif ($detail['class']=='s_obese') {
                                                            $bmi_class=$lang['s_obese'];
                                                        }
                                                    @endphp
                                                    <div class="text-center text-[20px]"><strong class="text-[#2845F5]">{{ $detail['BMI'] }}</strong></div>
                                                    <div class="text-[14px]">{{ $bmi_class }}</div>
                                                @else
                                                    <div class="text-center text-[20px]"><strong class="text-[#2845F5]">00.0</strong></div>
                                                    <div class="text-[14px]">{{ $lang['class'] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-lg-3 py-2">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/rmr.png') }}" width="50px" height="50px" alt="rmr">
                                                <p class="text-[18px] ms-2"><strong class="text-[#2845F5] ">RMR</strong></p>
                                            </div>
                                            <div>
                                                @if ($detail['rmr']!='')
                                                    <div class="text-center text-[20px]"><strong class="text-[#2845F5]">{{ $detail['rmr'] }}</strong></div>
                                                    <div class="text-[14px]">{{ $lang['Calories/Day'] }}</div>
                                                @else
                                                    <div class="text-center text-[20px]"><strong class="text-[#2845F5]">00.0</strong></div>
                                                    <div class="text-[14px]">{{ $lang['Calories/Day'] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($_POST['gender']=='Male' || $_POST['gender']=='Female')
                                        <div class="px-lg-3 py-2">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/healthy_bmi.png') }}" width="50px" height="50px" alt="rmr">
                                                    <p class="text-[18px] ms-2"><strong class="text-[#2845F5] ">Healthy BMI</strong></p>
                                                </div>
                                                <div>
                                                    @if ($detail['rmr']!='')
                                                        <div class="text-center text-[20px]"><strong class="text-[#2845F5]">18.5 - 24.9</strong></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif                        
                                    @if(isset($detail['bee']))
                                        <div class="px-lg-3 py-2">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ url('images/maintain.png') }}" width="50px" height="50px" alt="bee">
                                                    <p class="text-[18px] ms-2"><strong class="text-[#2845F5] ">BEE</strong></p>
                                                </div>
                                                <div>
                                                    @if ($detail['bee']!='')
                                                        <div class="text-center text-[20px]"><strong class="text-[#2845F5]">{{ $detail['bee'] }}</strong></div>
                                                        <div class="text-[14px]">{{ $lang['Calories/Day'] }}</div>
                                                    @else
                                                        <div class="text-center text-[20px]"><strong class="text-[#2845F5]">00.0</strong></div>
                                                        <div class="text-[14px]">{{ $lang['Calories/Day'] }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                               
                                <div class="col-span-12 overflow-auto px-lg-3">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <th class="text-start text-[#2845F5] border-b py-2">{{ $lang['level'] }}</th>
                                            <th class="text-start text-[#2845F5] border-b">{{ $lang['energy'] }}</th>
                                        </tr>
                                        <tr class="{{ isset($detail['stand'])?$detail['stand']:'' }}">
                                            <td class="border-b py-2 px-2">{{ $lang['stand'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['s']))
                                                    <span>{{ $detail['s'] }}</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @else
                                                    <span>00</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="{{ isset($detail['light'])?$detail['light']:'' }}">
                                            <td class="border-b py-2 px-2">{{ $lang['light'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['l']))
                                                    <span>{{ $detail['l'] }}</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @else
                                                    <span>00</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="{{ isset($detail['mod'])?$detail['mod']:'' }}">
                                            <td class="border-b py-2">{{ $lang['mod'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['m']))
                                                    <span>{{ $detail['m'] }}</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @else
                                                    <span>00</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="{{ isset($detail['very'])?$detail['very']:'' }}">
                                            <td class="py-2">{{ $lang['very'] }}</td>
                                            <td>
                                                @if (isset($detail['v']))
                                                    <span>{{ $detail['v'] }}</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @else
                                                    <span>00</span>
                                                    <span class="text-[14px]">{{ $lang['Calories/Day'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(isset($detail['EER_child']))
                        <div class="w-full text-center">
                            <p class="text-[20px] mb-2"><strong class="text-[#2845F5]">{{ $lang['your'] }}</strong></p>
                            <div class="d-inline-block bg-white rounded-lg px-3 py-2">
                                <span class="text-green font-s-25">{{ $detail['EER'] }}</span>
                                <span>{{ $lang['Calories/Day'] }}</span>
                            </div>
                            <p class="text-start mt-2">{{ $lang['child1'] }}</p>
                        </div>
                    @endif
                    <div class="w-full text-center mt-[25px]">
                        <a href="{{ url()->current() }}/" class="calculate pbg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
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
        <script>
            var doc_gender = document.getElementById('gender')
            if(doc_gender){
                doc_gender.addEventListener('change', function(){
                    var gender = this.value;
                    if (gender === 'pergnant') {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    } else if (gender === 'child') {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    } else if (gender === 'lac') {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    }
                    if (gender === 'obs_girl' || gender === 'obs_boy') {
                        document.querySelectorAll('.goal').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    }
    
                })
            }

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

            @isset($detail)
                var doc_units = document.getElementById('unit_ft_in')

                if(doc_units){
                    var val = doc_units.value;
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

                if(doc_gender){
                    var gender = doc_gender.value;
                    if (gender === 'pergnant') {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    } else if (gender === 'child') {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    } else if (gender === 'lac') {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.trim').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.period').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    }
                    if (gender === 'obs_girl' || gender === 'obs_boy') {
                        document.querySelectorAll('.goal').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    }
                }
            @endisset
        </script>
    @endpush
</form>