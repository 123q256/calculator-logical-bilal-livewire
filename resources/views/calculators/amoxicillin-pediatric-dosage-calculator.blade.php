<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">



            <div class="col-lg-6 px-2 pe-lg-4">
                <label for="age" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="age" id="age" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['age']) ? $_POST['age'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="age_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('age_unit_dropdown')">{{ isset($_POST['age_unit'])?$_POST['age_unit']:$lang['2']  }} ▾</label>
                    <input type="text" name="age_unit" value="{{ isset($_POST['age_unit'])?$_POST['age_unit']:$lang['2']  }}" id="age_unit" class="hidden">
                    <div id="age_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="age_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', '{{ $lang['2'] }}')">{{ $lang['2'] }}</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', '{{ $lang['3'] }}')">{{ $lang['3'] }}</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', '{{ $lang['4'] }}')">{{ $lang['4'] }}</p>
                    </div>
                 </div>
            </div>
            <div class="col-lg-6 px-2 ps-lg-4">
                <label for="weight" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                    <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                    <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">lbs</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'stone')">stone</p>
                    </div>
                 </div>
            </div>
            <div class="col-lg-6 px-2 pe-lg-4">
                <label for="med_type" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="med_type" id="med_type" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["(125 mg/5 mL)","(250 mg/5 mL)","(200 mg/5 mL)","(400 mg/5 mL)"];
                            $val = ["1","2","3","4"];
                            optionsList($val,$name,isset($_POST['med_type'])?$_POST['med_type']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-lg-6 px-2 ps-lg-4">
                <label for="general_dosing" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="general_dosing" id="general_dosing" class="input">
                        @php
                            $name = [$lang['8'],$lang['9'],$lang['10']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['general_dosing'])?$_POST['general_dosing']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-lg-6 px-2 pe-lg-4 route">
                <label for="route" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="route" id="route" class="input">
                        @php
                            $name = [$lang['12']."(PO)",$lang['13']."(IV)"];
                            $val = ["1","2"];
                            optionsList($val,$name,isset($_POST['route'])?$_POST['route']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-lg-6 px-2 ps-lg-4 dosag">
                <label for="dosag" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="dosag" id="dosag" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['dosag'])?$_POST['dosag']:'' }}" />
                    <span class="text-blue input_unit">mg/kg/dose</span>
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
                                @php
                                    $milli1=$detail['in_mm']*2;
                                    $milli2=$detail['in_milli']*2;
                                    $general_dosing=$detail['general_dosing'];
                                @endphp
                                <p class="w-full">{{ $lang['14'] }}</p>
                                @if($detail['general_dosing']=="1" || $detail['general_dosing']=="2" || $detail['general_dosing']=="3")
                                    <p class="text-blue font-s-18">
                                        @if($detail['general_dosing']=="1")
                                            @if($detail['route']=="1")
                                                3 {{ $lang['21'] }}/{{ $lang['22'] }} 8 Hours :
                                            @elseif($detail['route']=="2")
                                                3 {{ $lang['21'] }} :
                                            @endif
                                        @elseif($detail['general_dosing']=="2")
                                            {{ $lang['23'] }} 10 days :
                                        @elseif($detail['general_dosing']=="3")
                                            30-60 {{ $lang['24'] }}:
                                        @endif
                                    </p>
                                <div class="w-full overflow-auto mt-4">
                                    <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                        <tr>
                                            <td class="border-b py-3">
                                                <p class=""><strong>{{ $lang['15'] }} :</strong></p>
                                            </td>
                                            <td class="border-b">
                                                <p class="">
                                                    @if($detail['general_dosing']=="1")
                                                        <strong><span class="text-[#119154] text-[18px]"> {{ $detail['in_mm'] }} - {{ $milli1 }}</span><span class="text-blue"> (mg)</span></strong>
                                                    @elseif($detail['general_dosing']=="2" || $detail['general_dosing']=="3")
                                                        <strong><span class="text-[#119154] text-[18px]"> {{ $detail['in_mm'] }}</span><span class="text-blue"> (mg)</span></strong>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">
                                                <p class=""><strong>{{ $lang['16'] }} :</strong></p>
                                            </td>
                                            <td class="border-b">
                                                <p class="">
                                                    @if($detail['general_dosing']=="1")
                                                        <strong><span class="text-[#119154] text-[18px]"> {{ $detail['in_milli'] }} - {{ $milli2 }}</span><span class="text-blue"> (mL)</span></strong>
                                                    @elseif($detail['general_dosing']=="2" || $detail['general_dosing']=="3")
                                                        <strong><span class="text-[#119154] text-[18px]"> {{ $detail['in_milli'] }} </span><span class="text-blue"> (mL)</span></strong>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                    @if($detail['general_dosing']=="1")
                                        @if($detail['route']=="1")
                                            @if($milli1>500)
                                                <p class="mt-3"><b>❗</b> {{ $lang['25'] }} 500 milligrams per dose.</p>
                                                @if($milli1*3>4000)
                                                    <p class="mt-3"><b>❗</b> {{ $lang['25'] }} of 4 grams per day.</p>
                                                @endif
                                            @endif
                                        @elseif($detail['route']=="2")
                                            @if(($milli1*3>4000))
                                                <p class="mt-3"><b>❗</b> {{ $lang['25'] }} 4 grams per day.</p>\
                                            @endif
                                        @endif
                                    @elseif($detail['general_dosing']=="3")
                                        @if(($milli1/2)>2000)
                                            <p class="mt-3"><b>❗</b> {{ $lang['27'] }} 2 grams per dose.</p>
                                        @endif
                                    @endif
                                @endif
                                    @if($detail['dosag']!="")
                                        @if($detail['general_dosing']=="1")
                                            @if($detail['route']=="1")
                                                <p class="mt-3">{{ $lang['18'] }} : <strong class="text-[#119154]"><?php echo $detail['w_val']*$detail['dosag'] ?></strong><strong><span class="text-blue"> (mg) </span></strong></p>
                                                @if($detail['dosag']>=15 && $detail['dosag']<=30)
                                                    <p class="mt-3">✅ {{ $lang['19'] }} .</b></p>
                                                @else
                                                    <p class="mt-3">❌ {{ $lang['17'] }} .</b></p>
                                                @endif
                                            @elseif($detail['route']=="2")
                                                <p class="mt-3">{{ $lang['18'] }} : <strong class="text-[#119154]"><?php echo $detail['dosag']*$detail['w_val'] ?></strong><strong><span class="text-blue"> (mg) </span></strong></p>
                                                @if($detail['dosag']=="30")
                                                @elseif($detail['dosag']>=31 && $detail['dosag']<=60)
                                                    <p class="mt-3">✅ {{ $lang['19'] }}.</b></p>
                                                @else
                                                    <p class="mt-3">❌ {{ $lang['17'] }}.</b></p>
                                                @endif
                                            @endif
                                        @elseif($detail['general_dosing']=="2" || $detail['general_dosing']=="3")
                                            <p class="mt-3">{{ $lang['18'] }} : <strong class="text-[#119154]"><?php echo $detail['w_val']*$detail['dosag'] ?></strong><strong><span class="text-blue"> (mg) </span></strong></p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            var a = document.getElementById("general_dosing").value;
            if (a === "1") {
                document.querySelectorAll(".route").forEach(function(elem) {
                    elem.style.display = "block";
                });
                document.querySelectorAll(".dosag").forEach(function(elem) {
                    elem.classList.remove("pe-lg-4");
                    elem.classList.add("ps-lg-4");
                });
            } else if (a === "2" || a === "3") {
                document.querySelectorAll(".route").forEach(function(elem) {
                    elem.style.display = "none";
                });
                document.querySelectorAll(".dosag").forEach(function(elem) {
                    elem.classList.remove("ps-lg-4");
                    elem.classList.add("pe-lg-4");
                });
            }
            document.getElementById("general_dosing").addEventListener("change", function() {
                var a = this.value;
                if (a === "1") {
                    document.querySelectorAll(".route").forEach(function(elem) {
                        elem.style.display = "block";
                    });
                    document.querySelectorAll(".dosag").forEach(function(elem) {
                        elem.classList.remove("pe-lg-4");
                        elem.classList.add("ps-lg-4");
                    });
                } else if (a === "2" || a === "3") {
                    document.querySelectorAll(".route").forEach(function(elem) {
                        elem.style.display = "none";
                    });
                    document.querySelectorAll(".dosag").forEach(function(elem) {
                        elem.classList.remove("ps-lg-4");
                        elem.classList.add("pe-lg-4");
                    });
                }
            });
        </script>
    @endpush
</form>