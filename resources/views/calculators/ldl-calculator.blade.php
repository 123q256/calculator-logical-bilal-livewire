<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="total" class="label">{{ $lang['1'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="total" id="total" step="any" placeholder="{{ $lang[2] }}: 3.9 - 5.2"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['total']) ? $_POST['total'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="total_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('total_unit_dropdown')">{{ isset($_POST['total_unit'])?$_POST['total_unit']:'mmol/L' }} ▾</label>
                    <input type="text" name="total_unit" value="{{ isset($_POST['total_unit'])?$_POST['total_unit']:'mmol/L' }}" id="total_unit" class="hidden">
                    <div id="total_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="total_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'mmol/L')">mmol/L</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'mg/dL')">mg/dL</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="high" class="label">{{ $lang['3'] }} (HDL):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="high" id="high" step="any"  placeholder="{{ $lang[2] }}: 0 - 1.55"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['high']) ? $_POST['high'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="high_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('high_unit_dropdown')">{{ isset($_POST['high_unit'])?$_POST['high_unit']:'mmol/L' }} ▾</label>
                    <input type="text" name="high_unit" value="{{ isset($_POST['high_unit'])?$_POST['high_unit']:'mmol/L' }}" id="high_unit" class="hidden">
                    <div id="high_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="high_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('high_unit', 'mmol/L')">mmol/L</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('high_unit', 'mg/dL')">mg/dL</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="triglycerides" class="label">{{ $lang['4'] }} (TG):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="triglycerides" id="triglycerides" step="any" placeholder="{{ $lang[2] }}: 0 - 1.7"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['triglycerides']) ? $_POST['triglycerides'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="triglycerides_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('triglycerides_unit_dropdown')">{{ isset($_POST['triglycerides_unit'])?$_POST['triglycerides_unit']:'mmol/L' }} ▾</label>
                    <input type="text" name="triglycerides_unit" value="{{ isset($_POST['triglycerides_unit'])?$_POST['triglycerides_unit']:'mmol/L' }}" id="triglycerides_unit" class="hidden">
                    <div id="triglycerides_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="triglycerides_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('triglycerides_unit', 'mmol/L')">mmol/L</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('triglycerides_unit', 'mg/dL')">mg/dL</p>
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
                        <div class="w-ful">
                            <p class="mt-2"><strong>{{ $lang[5] }} (LDL)</strong></p>
                            <p><strong class="text-[#119154] text-[32px]">{{ number_format($detail['ldl_mmoll'], 1) }}</strong><span class="text-green-500 text-[20px]"> (mmol/L)</span></p>
                            <p><strong class="text-[#119154] text-[32px]">{{ number_format($detail['ldl_mgdL'], 1) }}</strong><span class="text-green-500 text-[20px]"> (mg/dL)</span></p>  
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>