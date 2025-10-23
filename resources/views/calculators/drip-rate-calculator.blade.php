<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg shadow-md space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    
                <div class="col-span-12">
                    <input type="radio" name="type" id="simple" value="first" checked {{ isset(request()->type) && request()->type === 'first' ? 'checked' : '' }}>
                    <label for="simple" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['14'] }}:</label>
                    <input type="radio" name="type" id="advance" value="second" {{ isset(request()->type) && request()->type === 'second' ? 'checked' : '' }}>
                    <label for="advance" class="font-s-14 text-blue">{{ $lang['15'] }}:</label>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 sam1">
                    <label for="v" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="v" id="v" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v']) ? $_POST['v'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="v_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v_unit_dropdown')">{{ isset($_POST['v_unit'])?$_POST['v_unit']:'mm³' }} ▾</label>
                        <input type="text" name="v_unit" value="{{ isset($_POST['v_unit'])?$_POST['v_unit']:'mm³' }}" id="v_unit" class="hidden">
                        <div id="v_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'mm³')">mm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'cm³')">cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'dm³')">dm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'ml')">ml</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'cl')">cl</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'l')">l</p>
                        </div>
                     </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 sam1">
                    <label for="t" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="t" id="t" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t']) ? $_POST['t'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'sec' }} ▾</label>
                        <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'sec' }}" id="t_unit" class="hidden">
                        <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'sec')">seconds (sec)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'min')">minutes (min)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hrs')">hours (hrs)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-12 md:col-span-6 lg:col-span-6 sam2 hidden">
                    <label for="d" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="d" id="d" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['d']) ? $_POST['d'] : '0.02' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:'mg/kg/min' }} ▾</label>
                        <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:'mg/kg/min' }}" id="d_unit" class="hidden">
                        <div id="d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mg/kg/min')">mg/kg/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mg/oz/min')">mg/oz/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mg/lb/min')">mg/lb/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mg/stone/min')">mg/stone/min</p>
                        </div>
                     </div>
                </div>
               
                <div class="col-span-12 md:col-span-6 lg:col-span-6 sam2 hidden">
                    <label for="bw" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bw" id="bw" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bw']) ? $_POST['bw'] : '85' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bw_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bw_unit_dropdown')">{{ isset($_POST['bw_unit'])?$_POST['bw_unit']:'kg' }} ▾</label>
                        <input type="text" name="bw_unit" value="{{ isset($_POST['bw_unit'])?$_POST['bw_unit']:'kg' }}" id="bw_unit" class="hidden">
                        <div id="bw_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bw_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bw_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bw_unit', 'oz')">ounces (oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bw_unit', 'pounds')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bw_unit', 'stone')">stone</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-12 md:col-span-6 lg:col-span-6 sam2 hidden">
                    <label for="bv" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bv" id="bv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bv']) ? $_POST['bv'] : '40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bv_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bv_unit_dropdown')">{{ isset($_POST['bv_unit'])?$_POST['bv_unit']:'ml' }} ▾</label>
                        <input type="text" name="bv_unit" value="{{ isset($_POST['bv_unit'])?$_POST['bv_unit']:'ml' }}" id="bv_unit" class="hidden">
                        <div id="bv_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bv_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bv_unit', 'ml')">milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bv_unit', 'cl')">centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bv_unit', 'l')">liters (l)</p>
                        </div>
                     </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 sam2 hidden">
                    <label for="drug" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="drug" id="drug" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['drug']) ? $_POST['drug'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="drug_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('drug_unit_dropdown')">{{ isset($_POST['drug_unit'])?$_POST['drug_unit']:'µg' }} ▾</label>
                        <input type="text" name="drug_unit" value="{{ isset($_POST['drug_unit'])?$_POST['drug_unit']:'µg' }}" id="drug_unit" class="hidden">
                        <div id="drug_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="drug_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('drug_unit', 'µg')">milcrograms (µg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('drug_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('drug_unit', 'g')">grams (g)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dp" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="dp" id="dp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dp']) ? $_POST['dp'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dp_unit_dropdown')">{{ isset($_POST['dp_unit'])?$_POST['dp_unit']:'gtts/mm³' }} ▾</label>
                        <input type="text" name="dp_unit" value="{{ isset($_POST['dp_unit'])?$_POST['dp_unit']:'gtts/mm³' }}" id="dp_unit" class="hidden">
                        <div id="dp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dp_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dp_unit', 'gtts/mm³')">drops (gtts) per millimeters cube (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dp_unit', 'gtts/cm')">drops (gtts) per centimeters cube (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dp_unit', 'gtts/ml')">drops (gtts) per milliliter (ml)</p>

                       
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
                        @if($detail['type']=="first")
                          <p class="text-center"><strong>{{ $lang['10'] }}</strong></p>
                          <p class="text-center"><strong class="text-[#119154] font-s-32">{{ round($detail['dr']) }}<span class="text-green-500 font-s-22"> (ml/h)</span></strong></p>
                          <div class="w-full md:w-[60%] lg:w-[60%]  mx-auto">
                              <div class="flex flex-wrap  justify-between">
                                <div class="text-center px-3 mt-3">
                                    <p><strong>{{ $lang['8'] }}</strong></p>
                                    <p class="text-[28px]"><strong class="text-[#119154]">{{ round($detail['dpm']) }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block mt-3">&nbsp;</div>
                                <div class="text-center px-3 mt-3">
                                    <p><strong>{{ $lang['9'] }}</strong></p>
                                    <p class="text-[28px]"><strong class="text-[#119154]">{{ round($detail['dph']) }}</strong></p>
                                </div>
                              </div>
                          </div>
                      @elseif($detail['type']=="second")
                        <p class="text-center"><strong>{{ $lang['10'] }}</strong></p>
                        <p class="text-center"><strong class="text-[#119154] font-s-32">{{ round($detail['dr']) }} <span class="text-green-500 font-s-22">(ml/h)</span></strong></p>
                        <div class="w-full md:w-[80%] lg:w-[80%]   mx-auto">
                            <div class="flex flex-wrap  justify-between">
                                <div class="text-center px-3 mt-3">
                                    <p><strong>{{ $lang['11'] }}</strong></p>
                                    <p class="text-[25px]"><strong class="text-[#119154]">{{ round($detail['concentration'],3) }} <span class="text-green-500 text-[18px]">(mg/L)</span></strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block mt-3">&nbsp;</div>
                                <div class="text-center px-3 mt-3">
                                    <p><strong>{{ $lang['12'] }}</strong></p>
                                    <p class="text-[25px]"><strong class="text-[#119154]">{{ round($detail['flow_rate'],3) }} <span class="text-green-500 text-[18px]">(gtts/per h)</span></strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block mt-3">&nbsp;</div>
                                <div class="text-center px-3 mt-3">
                                    <p><strong>{{ $lang['13'] }}</strong></p>
                                    <p class="text-[25px]"><strong class="text-[#119154]">{{ round($detail['time_to_bag'],2) }} <span class="text-green-500 text-[18px]">(hrs)</span></strong></p>
                                </div>
                            </div>
                        </div>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById("simple").addEventListener("click", function() {
                document.querySelectorAll(".sam2").forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll(".sam1").forEach(function(el) {
                    el.style.display = 'block';
                });
            });

            document.getElementById("advance").addEventListener("click", function() {
                document.querySelectorAll(".sam1").forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll(".sam2").forEach(function(el) {
                    el.style.display = 'block';
                });
            });
            @if(isset($detail))
                let val = "{{ request()->type }}"
                if (val === 'first') {
                    document.querySelectorAll(".sam2").forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll(".sam1").forEach(function(el) {
                        el.style.display = 'block';
                    });
                } else {
                    document.querySelectorAll(".sam1").forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll(".sam2").forEach(function(el) {
                        el.style.display = 'block';
                    });
                }
            @endif
        </script>
    @endpush
</form>