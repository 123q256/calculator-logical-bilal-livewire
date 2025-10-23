<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6 md:col-span-6 lg:col-span-6 hidden ft_in">
                <label for="time_min" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="time_min" id="time_min" class="input" aria-label="input" placeholder="min" value="{{ isset(request()->time_min)?request()->time_min:'9' }}" />
                </div>
            </div>
            <div class="col-span-6 md:col-span-6 lg:col-span-6 hidden ft_in">
                <label for="time_sec" class="font-s-14 text-blue">&nbsp;</label>
                <input type="text" name="time_unit" value="{{ isset(request()->time_unit)?request()->time_unit:'hrs' }}" id="time_unit" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="time_sec" id="time_sec" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time_sec']) ? $_POST['time_sec'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'min/sec' }} ▾</label>
                    <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'min/sec' }}" id="unit_h" class="hidden">
                    <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                        <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'sec')">feet / inches (ft/in)</p>
                        <p value="mins" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'mins')">minutes (mins)</p>
                        <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'hrs')">hours (hrs)</p>
                        <p value="days" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'days')">days</p>
                        <p value="min/sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'min/sec')">minutes / second (min/sec)</p>
                        <p value="hrs/min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'hrs/min')">hours / minute (hrs/min)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 h_cm">
                <label for="time" class="font-s-14 text-blue">{{ $lang['1'] }} <span class="text-blue timeUnit">(sec)</span>:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '12' }}" aria-label="input" placeholder="hrs" oninput="checkInput()"/>
                    <label for="unit_h_cm" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'min/sec' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'min/sec' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'sec')">feet / inches (ft/in)</p>
                        <p value="mins" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'mins')">minutes (mins)</p>
                        <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'hrs')">hours (hrs)</p>
                        <p value="days" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'days')">days</p>
                        <p value="min/sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'min/sec')">minutes / second (min/sec)</p>
                        <p value="hrs/min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'hrs/min')">hours / minute (hrs/min)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12">
                <label for="dosage" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="dosage" id="dosage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dosage']) ? $_POST['dosage'] : '1000' }}" aria-label="input" placeholder="hrs" oninput="checkInput()"/>
                    <label for="dosage_unit" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dosage_unit_dropdown')">{{ isset($_POST['dosage_unit'])?$_POST['dosage_unit']:'mg' }} ▾</label>
                    <input type="text" name="dosage_unit" value="{{ isset($_POST['dosage_unit'])?$_POST['dosage_unit']:'mg' }}" id="dosage_unit" class="hidden">
                    <div id="dosage_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dosage_unit">
                        <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dosage_unit', 'µg')">micrograms (µg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dosage_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dosage_unit', 'g')">grams (g)</p>
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
                    <div class="w-full p-3 mt-3">
                        <div class="w-full mt-2">
                            <div class="w-full overflow-auto">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <th class="text-start border-b py-2">
                                            <strong>
                                                    {{ $lang['4'] }} (
                                                    @php
                                                        if(request()->time_unit=="mins"){
                                                            echo"mins";
                                                        }elseif (request()->time_unit=="hrs"){
                                                            echo"hrs";
                                                        }elseif (request()->time_unit=="days"){
                                                            echo"days";
                                                        }elseif (request()->time_unit=="sec"){
                                                            echo"sec";
                                                        }elseif (request()->time_unit === 'min/sec'){
                                                            echo"mins";
                                                        }elseif (request()->time_unit === 'hrs/min'){
                                                            echo"hrs";
                                                        }
                                                    @endphp
                                                )
                                            </strong>
                                        </th>
                                        <th class="text-start border-b py-2"><strong>{{ $lang['2'] }} (mg)</strong></th>
                                        <th class="text-start border-b py-2"><strong>{{ $lang['5'] }}</strong></th>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['answer'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['subanswer'],2) }}</td>
                                        <td class="border-b py-2">50%</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['answer_one'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['subanswer_one'],2) }}</td>
                                        <td class="border-b py-2">25%</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['answer_two'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['subanswer_sec'],2) }}</td>
                                        <td class="border-b py-2">12.5%</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['answer_three'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['subanswer_three'],2) }}</td>
                                        <td class="border-b py-2">6.25%</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['answer_four'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['subanswer_four'],2) }}</td>
                                        <td class="border-b py-2">3.125%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $detail['answer_five'] }}</td>
                                        <td class="py-2">{{ round($detail['subanswer_five'],2) }}</td>
                                        <td class="py-2">1.562%</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endisset
    @push('calculatorJS')
        <script>
            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'min/sec' || val == 'hrs/min') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                        let placeholder = val.split('/')
                        document.getElementById('time_min').setAttribute('placeholder', placeholder[0])
                        document.getElementById('time_sec').setAttribute('placeholder', placeholder[1])
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.querySelector('.timeUnit').textContent = '('+val+')';
                        document.getElementById('time').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('time_unit').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            @if(isset($detail) || isset($error))
                var val = document.getElementById('time_unit').value;
                if (val == 'min/sec' || val == 'hrs/min') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                    let placeholder = val.split('/')
                    document.getElementById('time_min').setAttribute('placeholder', placeholder[0])
                    document.getElementById('time_sec').setAttribute('placeholder', placeholder[1])
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                    document.querySelector('.timeUnit').textContent = '('+val+')';
                    document.getElementById('time').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>