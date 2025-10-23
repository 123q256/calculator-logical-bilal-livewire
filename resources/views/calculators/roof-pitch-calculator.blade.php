<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="from" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
                    <select name="from" id="from" class="input my-2">
                        <option value="1" {{ isset($_POST['from']) && $_POST['from'] === '1' ? 'selected' : '' }}>{{ $lang['rise'] }} & {{ $lang['run'] }}</option>
                        <option value="2" {{ isset($_POST['from']) && $_POST['from'] === '2' ? 'selected' : '' }}> {{ $lang['rise'] }} & {{ $lang['rafter'] }}</option>
                        <option value="3" {{ isset($_POST['from']) && $_POST['from'] === '3' ? 'selected' : '' }}> {{ $lang['run'] }} & {{ $lang['rafter'] }}</option>
                        <option value="4" {{ isset($_POST['from']) && $_POST['from'] === '4' ? 'selected' : '' }}> {{ $lang['rise'] }} & {{ $lang['pit'] }} (%)</option>
                        <option value="5" {{ isset($_POST['from']) && $_POST['from'] === '5' ? 'selected' : '' }}> {{ $lang['rise'] }} & {{ $lang['roof'] }}</option>
                        <option value="6" {{ isset($_POST['from']) && $_POST['from'] === '6' ? 'selected' : '' }}> {{ $lang['rise'] }} & {{ $lang['pit'] }} (x:12)</option>
                        <option value="7" {{ isset($_POST['from']) && $_POST['from'] === '7' ? 'selected' : '' }}> {{ $lang['run'] }} & {{ $lang['pit'] }} (%)</option>
                        <option value="8" {{ isset($_POST['from']) && $_POST['from'] === '8' ? 'selected' : '' }}> {{ $lang['run'] }} & {{ $lang['roof'] }}</option>
                        <option value="9" {{ isset($_POST['from']) && $_POST['from'] === '9' ? 'selected' : '' }}> {{ $lang['run'] }} & {{ $lang['pit'] }} (x:12)</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue change-1">
                        @if(isset($_POST['from']) && ($_POST['from'] === '3' ||  $_POST['from'] === '7' ||   $_POST['from'] === '8' ||  $_POST['from'] === '9' ))
                            {{ $lang['run'] }}
                        @else
                            {{ $lang['rise'] }}
                        @endif
                    </label>
                    <div class="relative w-full ">
                        <input type="number" name="x" id="x" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x'])?$_POST['x']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'m' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'m' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'm')">meter (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inch (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'yd')">yard (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'ft')">foot (ft)</p>
                        </div>
                    </div>
                 </div>

                 <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue change-2">
                        @if(isset($_POST['from']) && ($_POST['from'] === '2' ||  $_POST['from'] === '3'))
                            {{ $lang['rafter'] }}
                        @elseif(isset($_POST['from']) && ($_POST['from'] === '4' ||  $_POST['from'] === '9' ||  $_POST['from'] === '7' ||  $_POST['from'] === '6'))
                            {{ $lang['pit'] }}
                        @elseif(isset($_POST['from']) && ($_POST['from'] === '5' ||  $_POST['from'] === '8'))
                            {{$lang['roof']}}
                        @else
                            {{ $lang['run'] }}
                        @endif
                    </label>
                  
                 

                    <div class="relative w-full  {{ isset($_POST['from']) && ($_POST['from'] === '4' || $_POST['from'] === '5' || $_POST['from'] === '6' || $_POST['from'] === '7' |$_POST['from'] === '8') ? 'hidden' : 'inline-block' }} run">
                        <input type="number" name="y" id="y" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y'])?$_POST['y']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_r" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_r_dropdown')">{{ isset($_POST['unit_r'])?$_POST['unit_r']:'m' }} ▾</label>
                        <input type="text" name="unit_r" value="{{ isset($_POST['unit_r'])?$_POST['unit_r']:'m' }}" id="unit_r" class="hidden">
                        <div id="unit_r_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'm')">meter (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'in')">inch (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'yd')">yard (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'ft')">foot (ft)</p>
                        </div>
                    </div>
                    <div class="relative w-full  angel {{ isset($_POST['from']) && ($_POST['from'] === '5' || $_POST['from'] === '8') ? 'inline-block' : 'hidden' }}">
                        <input type="number" name="y" id="y" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y'])?$_POST['y']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_a" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_a_dropdown')">{{ isset($_POST['unit_a'])?$_POST['unit_a']:'deg' }} ▾</label>
                        <input type="text" name="unit_a" value="{{ isset($_POST['unit_a'])?$_POST['unit_a']:'deg' }}" id="unit_a" class="hidden">
                        <div id="unit_a_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'deg')">deg </p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'red')">red</p>
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
                <div class="rounded-lg   items-center justify-center">
                    <div class="col-12 bg-light-blue result p-3 radius-10 mt-3">
                        <div class="w-full my-4">
                            <div class="w-full md:w-[50%] lg:w-[50%] overflow-auto">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['run'] }} :</strong></td>
                                            <td class="border-b py-2 ">{{ $detail['run'] != '' ? $detail['run'] . ' m' : '0.0m' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['rise'] }} :</strong></td>
                                            <td class="border-b py-2 ">
                                                {{ $detail['rise'] != '' ? $detail['rise'] . ' m' : '0.0m' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['rafter'] }} :</strong></td>
                                            <td class="border-b py-2 ">
                                                {{ $detail['rafter'] != '' ? $detail['rafter'] . ' m' : '0.0m' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['roof'] }} :</strong></td>
                                            <td class="border-b py-2 ">
                                                {{ $detail['angle'] != '' ? $detail['angle'] . ' deg' : '0.0 deg' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['roof'] }} (%) ({{ $lang['slope'] }}) :</strong></td>
                                            <td class="border-b py-2 ">
                                                {{ $detail['pitch'] != '' ? $detail['pitch'] . '%' : '0.0%' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['roof'] }} (x:12) :</strong></td>
                                            <td class="border-b py-2 ">
                                                <?= $detail['x'] != '' ? $detail['x'] . '<span class=' . 'font-s-14' . '> :12</span>' : '0.0 <span class="."font-s-14"."> :12</span>' ?>
                                                    in</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['p'] }} ({{ $lang['rise'] }}/{{ $lang['span'] }}) :
                                            </td>
                                            <td class="border-b py-2 ">{{ $detail['P'] != '' ? $detail['P'] : '0.0' }} ft</td>
                                        </strong></tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['rad'] }} :</strong></td>
                                            <td class="border-b py-2 ">
                                                {{ isset($detail['angle']) ? round($detail['angle'] * 0.0174533, 4) : '0.0' }}
                                            </td>
                                        </tr>
                                    </tbody>
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
            function getSelectedOption() {
                var value = this.value;
                if (value !== 'empty') {
                    var unit = document.getElementById('from').value;
                    var unit_r = document.querySelector('.run');
                    var unit_a = document.querySelector('.angel');
                    
                    // Show 'angel' and hide 'run' when the unit is 8 or 5
                    if (unit == '8' || unit == '5') {
                        unit_a.classList.remove('hidden');
                        unit_a.classList.add('inline-block'); // Tailwind equivalent of 'd-inline'
                        unit_r.classList.add('hidden');
                        unit_r.classList.remove('inline-block');
                    
                    // Show 'run' and hide 'angel' when the unit is 1, 2, or 3
                    } else if (unit == '1' || unit == '2' || unit == '3') {
                        unit_a.classList.add('hidden');
                        unit_a.classList.remove('inline-block');
                        unit_r.classList.remove('hidden');
                        unit_r.classList.add('inline-block');
                    
                    // Hide both 'run' and 'angel' for other units
                    } else {
                        unit_a.classList.add('hidden');
                        unit_r.classList.add('hidden');
                    }
                }

                var selectElement = document.getElementById("from");
                var selectedOptionText = selectElement.options[selectElement.selectedIndex].text;
                var splitText = selectedOptionText.split(" & ");
                var one = document.querySelector('.change-1').innerHTML  = splitText[0];
                var two = document.querySelector('.change-2').innerHTML  = splitText[1];
            }
            document.getElementById('from').addEventListener('change', getSelectedOption);
        </script>
    @endpush
</form>
