<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="calculate" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="calculate" id="calculate">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["AC BTU", $lang['2']];
                                $val = ["ac","heating"];
                                optionsList($val,$name,isset(request()->calculate)?request()->calculate:'ac');
                            @endphp
                        </select>
                    </div>
                </div>

                                  
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="length" class="label">{{ $lang['7'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'kg' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'kg' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            @foreach (["m","ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 tip mt-2">
                    <label for="width" class="label">{{ $lang['8'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'kg' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'kg' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            @foreach (["m","ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ppl mt-2">
                    <label for="height" class="label">{{ $lang['9'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'kg' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'kg' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            @foreach (["m","ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
              
              
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="type" class="label">{!! $lang['10'] !!}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="type" id="type">
                            @php
                                $name = [ $lang['7'],$lang[8],$lang[9],$lang[10],$lang[11],$lang[12]];
                                $val = ["bedroom","living-room","kitchen","house","first-floor","above-floor"];
                                optionsList($val,$name,isset(request()->type)?request()->type:'bedroom');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 peoples">
                    <label for="peoples" class="label">{!! $lang['13'] !!}:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="peoples" id="peoples" class="input" aria-label="input"
                            placeholder="{{ $lang['3'] }}" value="{{ isset(request()->peoples) ? request()->peoples : '8' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="insulation_condition" class="label">{!! $lang['14'] !!}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="insulation_condition" id="insulation_condition">
                            @php
                                $name = [ $lang['15'],$lang[16],$lang[17]];
                                $val = ["good","average","poor"];
                                optionsList($val,$name,isset(request()->insulation_condition)?request()->insulation_condition:'average');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 sun-exposure">
                    <label for="sun_exposure" class="label">{!! $lang['18'] !!}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="sun_exposure" id="sun_exposure">
                            @php
                                $name = [ $lang['19'],$lang[20],$lang[21]];
                                $val = ["shaded","average","sunny"];
                                optionsList($val,$name,isset(request()->sun_exposure)?request()->sun_exposure:'average');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 climate">
                    <label for="climate" class="label">{!! $lang['22'] !!}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="climate" id="climate">
                            @php
                                $name = [ $lang['23']."(e.g. Boston)",$lang[24],$lang[25]." (e.g. Houston)"];
                                $val = ["cold","average","hot"];
                                optionsList($val,$name,isset(request()->climate)?request()->climate:'average');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 desired-temperature">
                    <label for="temperature" class="label">{!! $lang['26'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="temperature" id="temperature" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temperature']) ? $_POST['temperature'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="temperature_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temperature_unit_dropdown')">{{ isset($_POST['temperature_unit'])?$_POST['temperature_unit']:'kg' }} ▾</label>
                        <input type="text" name="temperature_unit" value="{{ isset($_POST['temperature_unit'])?$_POST['temperature_unit']:'kg' }}" id="temperature_unit" class="hidden">
                        <div id="temperature_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="temperature_unit">
                            @foreach (["m","ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('temperature_unit', '{{ $name }}')"> {{ $name }}</p>
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
                        <div class="w-full my-2">
                            <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <p>
                                    <strong> <?php echo (request()->calculate == 'ac') ? $lang[27] : $lang[28];?> </strong>
                                </p>
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2">BTU :</td>
                                        <td class="border-b py-2"><?=$detail['total_btu']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">ton :</td>
                                        <td class="border-b py-2"><?=$detail['ton']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">watts :</td>
                                        <td class="border-b py-2"><?=$detail['watts']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">kilowatt :</td>
                                        <td class="border-b py-2"><?=$detail['kilowatts'] ?></td>
                                    </tr> 
                                    <tr>
                                        <td class="border-b py-2">hp(I) :</td>
                                        <td class="border-b py-2"><?=$detail['hp_i'] ?></td>
                                    </tr> 
                                    <tr>
                                        <td class="border-b py-2">hp(E) :</td>
                                        <td class="border-b py-2"><?=$detail['hp_e'] ?></td>
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
        var value = document.getElementById("calculate").value;
        if (value == "ac") {
            document.querySelectorAll(".peoples, .sun-exposure, .climate").forEach(function(element) {
                element.style.display = "block";
            });
            document.querySelector(".desired-temperature").style.display = "none";
        }
        @if(isset($detail) || isset($error))
            if (value == "ac") {
                document.querySelectorAll(".peoples, .sun-exposure, .climate").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelector(".desired-temperature").style.display = "none";
            } else {
                document.querySelector(".desired-temperature").style.display = "block";
                document.querySelectorAll(".peoples, .sun-exposure, .climate").forEach(function(element) {
                    element.style.display = "none";
                });
            }
        @endif

        document.getElementById("calculate").addEventListener("change", function() {
            var value = this.value;
            if (value == "ac") {
                document.querySelectorAll(".peoples, .sun-exposure, .climate").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelector(".desired-temperature").style.display = "none";
            } else {
                document.querySelector(".desired-temperature").style.display = "block";
                document.querySelectorAll(".peoples, .sun-exposure, .climate").forEach(function(element) {
                    element.style.display = "none";
                });
            }
        });

    </script>
@endpush
