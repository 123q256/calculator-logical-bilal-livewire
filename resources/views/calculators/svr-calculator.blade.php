<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-lg-6 px-2 pe-lg-4">
                    <label for="map" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="map" id="map" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['map']) ? $_POST['map'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="map_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('map_unit_dropdown')">{{ isset($_POST['map_unit'])?$_POST['map_unit']:'mmHg' }} ▾</label>
                        <input type="text" name="map_unit" value="{{ isset($_POST['map_unit'])?$_POST['map_unit']:'mmHg' }}" id="map_unit" class="hidden">
                        <div id="map_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="map_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('map_unit', 'mmHg')">mmHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('map_unit', 'cmH2O')">cmH2O</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('map_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('map_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('map_unit', 'psi')">psi</p>
                        </div>
                     </div>
                </div>
                <div class="col-lg-6 px-2 ps-lg-4">
                    <label for="cvp" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="cvp" id="cvp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cvp']) ? $_POST['cvp'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cvp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cvp_unit_dropdown')">{{ isset($_POST['cvp_unit'])?$_POST['cvp_unit']:'mmHg' }} ▾</label>
                        <input type="text" name="cvp_unit" value="{{ isset($_POST['cvp_unit'])?$_POST['cvp_unit']:'mmHg' }}" id="cvp_unit" class="hidden">
                        <div id="cvp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cvp_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cvp_unit', 'mmHg')">mmHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cvp_unit', 'cmH2O')">cmH2O</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cvp_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cvp_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cvp_unit', 'psi')">psi</p>
                        </div>
                     </div>
                </div>
                <div class="col-lg-6 px-2 pe-lg-4">
                    <label for="co" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="co" id="co" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['co']) ? $_POST['co'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="co_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('co_unit_dropdown')">{{ isset($_POST['co_unit'])?$_POST['co_unit']:'L/min' }} ▾</label>
                        <input type="text" name="co_unit" value="{{ isset($_POST['co_unit'])?$_POST['co_unit']:'L/min' }}" id="co_unit" class="hidden">
                        <div id="co_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="co_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('co_unit', 'L/min')">L/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('co_unit', 'mL/min')">mL/min</p>
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
                    <div class="col-12 text-center">
                        <p><strong>{{ $lang['4'] }} (SVR)</strong></p>
                        <p>
                            <strong class="text-[#119154] lg:text-[32px] md:text-[32px] text-[27px]">{{ round($detail['svr'],2) }}</strong>
                            <strong class="text-[#119154] lg:text-[20px] md:text-[20px] text-[19px]">(dynes-sec/cm5)</strong>
                        </p>
                        <p>Normal range lies between 700 and 1600 dynes-sec/cm5.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>