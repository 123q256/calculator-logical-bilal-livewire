<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="volume" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="volume" id="volume" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="vol_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vol_unit_dropdown')">{{ isset($_POST['vol_unit'])?$_POST['vol_unit']:'mm³' }} ▾</label>
                        <input type="text" name="vol_unit" value="{{ isset($_POST['vol_unit'])?$_POST['vol_unit']:'mm³' }}" id="vol_unit" class="hidden">
                        <div id="vol_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'mm³')">mm³</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cm³')">cm³</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'dm³')">dm³</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'm³')">m³</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cu in')">cu in</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cu ft')">cu ft</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cu yd')">cu yd</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'ml')">ml</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cl')">cl</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'liters')">liters</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'US gal')">US gal</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'UK gal')">UK gal</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'US fl oz')">US fl oz</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'UK fl oz')">UK fl oz</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cups')">cups</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'tbsp')">tbsp</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'tsp')">tsp</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'US qt')">tt</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'UK qt')">UK qt</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'US pt')">US pt</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'UK pt')">UK pt</p>
                       
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="time" class="font-s-14 text-blue cat">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="time" id="time" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time'])?$_POST['time']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }} ▾</label>
                        <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }}" id="time_unit" class="hidden">
                        <div id="time_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'sec')">sec</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'min')">min</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'hrs')">hrs</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'days')">{{$lang[3]}}></p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'wks')">wks</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'mos')">mos</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'yrs')">yrs</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 relative">
                    <label for="ans_unit" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <select class="input" name="ans_unit" id="ans_unit">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["US gal/s","US gal/min","US gal/h","US gal/day","UK gal/s","UK gal/min","UK gal/h","UK gal/day","ft³/s","ft³/min","ft³/h", "ft³/day", "mm³/s", "m³/s", "m³/min", "m³/h", "m³/day", "L/s", "L/min", "L/h", "L/day","ml/min","ml/h","US fl oz / min","US fl oz / h","UK fl oz / min","UK fl oz / h","US pt / min","US pt / h", "UK pt / min","UK pt / h"];
                                        $val = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
                            optionsList($val,$name,isset($_POST['ans_unit'])?$_POST['ans_unit']:'12');
                        @endphp
                    </select>
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
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                        <div class="flex justify-center mt-3">
                            <div class="text-center">
                                <p class="text-lg font-semibold px-3">{{ $lang['4']}}</p>
                                <p class="lg:text-4xl md:text-4xl px-3 py-2 bg-[#2845F5] text-white inline-block rounded-lg my-3">
                                    <strong class="text-blue">{{ round($detail['main_ans'], 6) }}</strong>
                                    <span class="text-base">{{ $detail['answer_unit'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    @endisset
</form>