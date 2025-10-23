    <style>
        .onetw{
            background: transparent;
            border: none;
            color: #1670a7;
            outline: none;
        }
        @media (max-width: 360px) {
            .calculator-box{
                padding-right: 0rem;
                padding-left: 0rem;
            }
            label{
                font-size: 12px !important;
            }
        }
    </style>
    <form class="row" action="{{ url()->current() }}/" method="POST">
        @csrf
       

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="temp" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="relative w-full ">
                            <input type="number" name="temp" id="temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp'])?$_POST['temp']:'17' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_unit_dropdown')">{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }} ▾</label>
                            <input type="text" name="temp_unit" value="{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }}" id="temp_unit" class="hidden">
                            <div id="temp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°C')">°C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°F')">°F</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', 'K')">K</p>
                           
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="hum" class="font-s-14 text-blue">{{ $lang['2'] }}(%):</label>
                        <input type="number" step="any" name="hum" id="hum" class="input" aria-label="input"
                        placeholder="50" value="{{ isset($_POST['hum']) ? $_POST['hum'] : '65' }}" />
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <label for="temp1" class="text-sm text-blue">{{ $lang['3'] }}</label>
                            <span class="text-blue">({{ $lang['4'] }})</span>
                        </div>
                        <div class="relative w-full ">
                            <input type="number" name="temp1" id="temp1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp1'])?$_POST['temp1']:'17' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="temp1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp1_unit_dropdown')">{{ isset($_POST['temp1_unit'])?$_POST['temp1_unit']:'°C' }} ▾</label>
                            <input type="text" name="temp1_unit" value="{{ isset($_POST['temp1_unit'])?$_POST['temp1_unit']:'°C' }}" id="temp1_unit" class="hidden">
                            <div id="temp1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp1_unit', '°C')">°C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp1_unit', '°F')">°F</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp1_unit', 'K')">K</p>
                           
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue   rounded-lg mt-3">
                        <div class="w-full  mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b {{ $device == 'desktop' ? 'w-7/10' : '' }}">
                                        <strong>{{ $lang[5] }}</strong>
                                    </td>
                                    <td class="py-2 border-b">
                                        <span class="circle_result">
                                            {{ round($detail['ans'], 5) }}  
                                        </span>
                                        <select name="circle_unit_result" class="lg:w-[20%] md:w-[40%] sm:w-[50%] w-[80%] onetw d-inline ms-2 text-base">
                                            @php
                                                function optionsList($arr1, $arr2, $unit) {
                                                    foreach ($arr1 as $index => $name) {
                                            @endphp
                                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? ' selected' : '' }}>
                                                    {{ $arr2[$index] }}
                                                </option>
                                            @php
                                                    }
                                                }
                                                $name = ["°C", "°F", "K"];
                                                $val = ["C", "F", "K"];
                                                optionsList($val, $name, isset($_POST['circle_unit_result']) ? $_POST['circle_unit_result'] : 'C');
                                            @endphp
                                        </select>
                                    </td>
                                </tr>
                            </table>
                    
                            <table class="w-full text-lg">
                                @if (isset($detail['outdoor']))
                                <tr>
                                    <td class="py-2 border-b {{ $device == 'desktop' ? 'w-7/10' : '' }}">
                                        <strong>{{ $lang[11] }} ({{ $lang[12] }})</strong>
                                    </td>
                                    <td class="py-2 border-b">
                                        <span class="circle_result">{{ round($detail['outdoor'], 5) }}</span>
                                        <select name="circle_unit_result2" class="lg:w-[20%] md:w-[40%] sm:w-[50%] w-[80%] onetw d-inline ms-2 text-base">
                                            @php
                                                $name = ["°C", "°F", "K"];
                                                $val = ["C", "F", "K"];
                                                optionsList($val, $name, isset($_POST['circle_unit_result2']) ? $_POST['circle_unit_result2'] : 'C');
                                            @endphp
                                        </select>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="py-2 border-b {{ $device == 'desktop' ? 'w-7/10' : '' }}">
                                        <strong>{{ $lang[11] }} ({{ $lang[13] }})</strong>
                                    </td>
                                    <td class="py-2 border-b">
                                        <span class="circle_result">{{ round($detail['indoor'], 5) }}</span>
                                        <select style="border:none;" name="circle_unit_result3" class="lg:w-[20%] md:w-[40%] sm:w-[50%] w-[80%] onetw d-inline ms-2 text-base">
                                            @php
                                                $name = ["°C", "°F", "K"];
                                                $val = ["C", "F", "K"];
                                                optionsList($val, $name, isset($_POST['circle_unit_result3']) ? $_POST['circle_unit_result3'] : 'C');
                                            @endphp
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            @if ($detail['ans'] < 32)
                                <p class="my-2">{{ $lang[6] }}.</p>
                            @elseif($detail['ans'] >= 32 && $detail['ans'] < 35)
                                <p class="my-2">{{ $lang[7] }} 32 °C (90 °F) {{ $lang[8] }}.</p>
                            @elseif($detail['ans'] >= 35)
                                <p class="my-2">{{ $lang[9] }} 35 °C (95 °F) {{ $lang[10] }}.</p>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @endisset
        @push('calculatorJS')
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    document.querySelectorAll('.circle_result').forEach(circleResultDiv => {
                        const initialValue = parseFloat(circleResultDiv.innerText);
                        circleResultDiv.setAttribute('data-initial-value', initialValue);
                    });
    
                    document.querySelectorAll('.onetw').forEach(selectElement => {
                        selectElement.addEventListener('change', event => {
                            const unit = event.target.value;
                            const circleResultDiv = event.target.previousElementSibling;
                            const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                            let newValue;
                            if(unit == 'F'){
                                newValue = originalValue * (9 / 5) + 32;
                            } else if(unit == 'K'){
                                newValue = originalValue + 273.15;
                            } else {
                                newValue = originalValue;
                            }
                            circleResultDiv.innerText = Number(newValue.toFixed(4)).toString();
                        });
                    });
                });
            </script>
        @endpush
    </form>    
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>