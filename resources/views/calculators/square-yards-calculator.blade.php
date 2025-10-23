<style>
    #onetw{
        /* background: transparent; */
        border: none;
        color: #1670a7;
        outline: none;
    } 
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-4">

                <div class="col-span-6">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'cm' }} ▾</label>
                        <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'cm' }}" id="unit1" class="hidden">
                        <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'cm' }} ▾</label>
                        <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'cm' }}" id="unit2" class="hidden">
                        <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']:'cm' }} ▾</label>
                        <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']:'cm' }}" id="unit3" class="hidden">
                        <input type="hidden" name="currancy" value="{{$currancy}}">
                        <div id="unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit3">
                            @foreach (["mm²", "cm²", "m²", "km²", "in²", "ft²", "yd²", "a", "da", "ha", "ac"] as $item)
                               <p  class="p-2 hover:bg-gray-100 cursor-pointer" 
                                            onclick="setUnit('unit3', '{{$currancy.' '.$item}}')">
                                            {{$currancy.' '.$item}}
                                        </p>
                         @endforeach
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
                    <div class="w-full">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td width="60%" class="border-b py-2">
                                        <strong>{{ $lang['4'] }} :</strong></td>
                                    <td class="border-b py-2">
                                        <span id="circle_result">{{ round($detail['yd_ans'], 3) }} </span>
                                        <select name="circle_unit_result" id="onetw" class="d-inline ms-1 text-[17px] w-[80px]">
                                            @php
                                                function optionsList($arr1,$arr2,$unit){
                                                foreach($arr1 as $index => $name){
                                            @endphp
                                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                                    {{ $arr2[$index] }}
                                                </option>
                                                @php
                                                }}
                                                $name = ["in²","cm²","m²","ft²","yd²","km²","a","ac","ha"];
                                                $val = ["in²","cm²","m²","ft²","yd²","km²","a","ac","ha"];
                                                optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:'cm²');
                                            @endphp
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        <strong>{{ $lang['5'] }} :</strong></td>
                                    <td class="border-b py-2">{{ $currancy.' '.$detail['price'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const conversionFactors = {
                'in²': 6.452, // in to cm
                'cm²': 1,        // cm to cm
                'ft²': 929, // ft to cm
                'yd²': 8361, // yd to cm
                'm²': 10000,    // m to cm
                'km²': 10000000000,    // m to cm
                'a': 1000000,    // m to cm
                'ac': 40468560,    // m to cm
                'ha': 100000000,    // m to cm
            };

            const circleResultDiv = document.getElementById('circle_result');
            const initialValue = parseFloat(circleResultDiv.innerText);
            circleResultDiv.setAttribute('data-initial-value', initialValue);

            document.getElementById('onetw').addEventListener('change', event => {
                const unit = event.target.value;
                const conversionFactor = conversionFactors[unit];

                if (conversionFactor !== undefined) {
                    const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                    const newValue = originalValue / conversionFactor;
                    circleResultDiv.innerText = Number(newValue.toFixed(6)).toString()  // Set the new value with unit
                } else {
                    console.error("Invalid conversion factor for unit: " + unit);
                }
            });
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>