<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="font-s-14 text-blue">{!! $lang['gender'] !!}:</label>
                    <div class="w-100 py-2 relative">
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
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height-ft" class="font-s-14 text-blue">{!! $lang['height'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height-ft" id="height-ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height-ft'])?$_POST['height-ft']:'5' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height-in" class="font-s-14 text-blue">&nbsp;</label>
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
                    <label for="height-cm" class="font-s-14 text-blue">{{ $lang['height'] }} (cm):</label>
                    <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height-cm" id="height-cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm']) ? $_POST['height-cm'] : '175' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p  value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['weight'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '175' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="formula" class="font-s-14 text-blue">{!! $lang['formula'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="formula" id="formula" class="input">
                            @php
                                $name = ["Boer","James","Hume","Peters (".$lang['1'].")"];
                                $val = ["Boer","James","Hume","Peters"];
                                optionsList($val,$name,isset($_POST['formula'])?$_POST['formula']:'Boer');
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
                    <div class="w-full mt-3 flex justify-center">
                        <div class="w-full md:w-[65%] lg:w-[65%] mt-2">

                            <div class="bg-[#F6FAFC] text-center border rounded-lg p-3" style="border: 1px solid #c1b8b899">
                                <p class="text-[18px]"><strong>{{ $lang['2'] }}</strong></p>
                                <p class="">
                                    <strong class="text-blue-700 text-[18px]">{{ $lang['3'] }}</strong>
                                    <strong class="text-green-700 text-[22px]">{{ $detail['ans'] }} <span class="text-blue-700 text-[18px]">{{ $_POST['unit'] }}</span></strong>
                                </p>
                            </div>
                            <div class="flex items-center justify-between bg-[#F6FAFC] text-center border rounded-lg p-3" style="border: 1px solid #c1b8b899">
                                <p class="w-full text-center">{{ $lang['3'] }} % <strong class="text-blue-700 font-s-20 ps-2">{{ $detail['ans_per'] }}%</strong></p>
                                <p class="border-r mx-3">&nbsp;</p>
                                <p class="w-full text-center">{{ $lang['body_fat'] }} % <strong class="text-blue-700 font-s-20 ps-2">{{ 100 - $detail['ans_per'] }}%</strong></p>
                            </div>

                            <p class="text-[18px] my-4"><strong>{{ $lang['text'] }}</strong></p>
                            <div class="w-full overflow-auto mt-2">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <th class="text-blue-700 text-start py-3">{{ $lang['formula'] }}</th>
                                        <th class="text-blue-700 text-start">{{ $lang['3'] }}</td>
                                        <th class="text-blue-700 text-start">{{ $lang['body_fat'] }}</th>
                                    </tr>
                                    <tr class="{{ isset($detail['Boer_f']) ? $detail['Boer_f'] : '' }} bg-[#2845F5]">
                                        <td class="border-b px-2 py-3">Boer</td>
                                        <td class="border-b px-2 py-3">{!! (($detail['Boer']!='')?$detail['Boer']." <sub>(".$detail['Boer_per']."%)</sub>":'0.0kg') !!}</td>
                                        <td class="border-b px-2 py-3">{{ (($detail['Boer_per']!='')? 100-$detail['Boer_per']."%":'0.0%') }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['James_f']) ? $detail['James_f'] : '' }}">
                                        <td class="border-b px-2 py-3">James</td>
                                        <td class="border-b px-2 py-3">{!! (($detail['James']!='')?$detail['James']." <sub>(".$detail['James_per']."%)</sub>":'0.0kg') !!}</td>
                                        <td class="border-b px-2 py-3">{{ (($detail['James_per']!='')? 100-$detail['James_per']."%":'0.0%') }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['Hume_f']) ? $detail['Hume_f'] : '' }}">
                                        <td class="border-b px-2 py-3">Hume</td>
                                        <td class="border-b px-2 py-3">{!! (($detail['Hume']!='')?$detail['Hume']." <sub>(".$detail['Hume_per']."%)</sub>":'0.0kg') !!}</td>
                                        <td class="border-b px-2 py-3">{{ (($detail['Hume_per']!='')? 100-$detail['Hume_per']."%":'0.0%') }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['Peters_f']) ? $detail['Peters_f'] : '' }}">
                                        <td class="px-2 py-3">Peters ({{ $lang['1'] }})</td>
                                        <td class="px-2 py-3">{!! (($detail['Peters']!='')?$detail['Peters']." <sub>(".$detail['Peters_per']."%)</sub>":'0.0kg') !!}</td>
                                        <td class="px-2 py-3">{{ (($detail['Peters_per']!='')? 100-$detail['Peters_per']."%":'0.0%') }}</td>
                                    </tr>
                                </table>
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
    @endisset
    @push('calculatorJS')
        <script>
            var get_document = document.getElementById('unit_ft_in')
            if(get_document){
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
            }
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>