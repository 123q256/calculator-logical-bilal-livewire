<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="w" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="w" id="w" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w']) ? $_POST['w'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="w1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w1_dropdown')">{{ isset($_POST['w1'])?$_POST['w1']:'kg' }} ▾</label>
                        <input type="text" name="w1" value="{{ isset($_POST['w1'])?$_POST['w1']:'kg' }}" id="w1" class="hidden">
                        <div id="w1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="w1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d1', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d1', 'lbs')">pounds (lbs)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="d" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="d" id="d" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['d']) ? $_POST['d'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="d1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d1_dropdown')">{{ isset($_POST['d1'])?$_POST['d1']:'µg/kg' }} ▾</label>
                        <input type="text" name="d1" value="{{ isset($_POST['d1'])?$_POST['d1']:'µg/kg' }}" id="d1" class="hidden">
                        <div id="d1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d1', 'µg/kg')">grams per liter (g/L)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d1', 'mg/kg')">milligrams per liter (mg/mL)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d1', 'g/kg')">micrograms per liter (µg/L)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="f" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="f" id="f" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11']];
                                $val = ["1","2","3","4","4h","3h","2h","h"];
                                optionsList($val,$name,isset($_POST['f'])?$_POST['f']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mc" class="label">{{ $lang['12'] }} <span class="text-black">({{ $lang['17'] }})</span></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="mc" id="mc" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mc']) ? $_POST['mc'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mc1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mc1_dropdown')">{{ isset($_POST['mc1'])?$_POST['mc1']:'g/L' }} ▾</label>
                        <input type="text" name="mc1" value="{{ isset($_POST['mc1'])?$_POST['mc1']:'g/L' }}" id="mc1" class="hidden">
                        <div id="mc1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mc1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mc1', 'g/L')">grams per liter (g/L)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mc1', 'mg/mL')">milligrams per liter (mg/mL)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mc1', 'µg/L')">micrograms per liter (µg/L)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mc1', 'mg/mL')">milligrams per milliliter (mg/mL)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mc1', 'µg/mL')">micrograms per milliliter (µg/mL)</p>
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
                    <div class="w-full mt-2">
                        <div class="row items-center bg-[#F6FAFC] border rounded-lg px-4 py-2" style="border: 1px solid #c1b8b899;">
                            <p class="col-lg-6"><strong>{{ $lang['13'] }}</strong></p>
                            <p class="col-lg-6">
                                <strong class="text-green-500 text-[25px]">{{ $detail['tdose'] }} mg</strong>
                                <span class="text-blue ms-2">({{ $detail['ug'] }} µg, {{ $detail['gr'] }} g)</span>
                            </p>
                        </div>
                        @if(isset($detail['dose']))
                            <div class="row items-center bg-[#F6FAFC] border rounded-lg px-4" style="border: 1px solid #c1b8b899;">
                                <p class="col-lg-6"><strong>{{ $lang['14'] }}</strong></p>
                                <p class="col-lg-6">
                                    <strong class="text-green-500 text-[25px]">{{ $detail['dose'] }} mg</strong>
                                </p>
                            </div>
                        @endif
                        @if(!empty($detail['lq_dose']))
                            <div class="row items-center bg-[#F6FAFC] border rounded-lg px-4 py-2 mt-3" style="border: 1px solid #c1b8b899;">
                                <p class="col-lg-6"><strong>{{ $lang['15'] }}</strong></p>
                                <p class="col-lg-6">
                                    <strong class="text-green-500 text-[25px]">{{ $detail['lq_dose'] }} ml</strong>
                                    <span class="text-blue ms-2">({{ $detail['g'] }} L)</span>
                                </p>
                            </div>
                            @if(!empty($detail['lq_dose1']))
                                <div class="row items-center bg-[#F6FAFC] border rounded-lg px-4" style="border: 1px solid #c1b8b899;">
                                    <p class="col-lg-6"><strong>{{ $lang['16'] }}</strong></p>
                                    <p class="col-lg-6">
                                        <strong class="text-green-500 text-[25px]">{{ $detail['lq_dose1'] }} ml</strong>
                                    </p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>