<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <p><strong class="text-blue">{{ $lang['12'] }} =</strong> <span>10 : 1</span></p>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="bun" class="font-s-14 text-blue">{{ $lang['1'].' - '.$lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bun" id="bun" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bun']) ? $_POST['bun'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bun_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bun_unit_dropdown')">{{ isset($_POST['bun_unit'])?$_POST['bun_unit']:'mg/dL' }} ▾</label>
                        <input type="text" name="bun_unit" value="{{ isset($_POST['bun_unit'])?$_POST['bun_unit']:'mg/dL' }}" id="bun_unit" class="hidden">
                        <div id="bun_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bun_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bun_unit', 'mg/dL')">milligrams per deciliter (mg/dL)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bun_unit', 'mmol/L')">millimoles per liter (mmol/L)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="serum" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="serum" id="serum" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['serum']) ? $_POST['serum'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="serum_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('serum_unit_dropdown')">{{ isset($_POST['serum_unit'])?$_POST['serum_unit']:'mg/dL' }} ▾</label>
                        <input type="text" name="serum_unit" value="{{ isset($_POST['serum_unit'])?$_POST['serum_unit']:'mg/dL' }}" id="serum_unit" class="hidden">
                        <div id="serum_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="serum_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('serum_unit', 'mg/dL')">milligrams per deciliter (mg/dL)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('serum_unit', 'mmol/L')">millimoles per liter (mmol/L)</p>
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
                        <p>{{ $lang['4'] }}</p>
                        <p class="text-[28px]"><strong class="text-green-700">{{ round($detail['ans'],2) }}</strong></p>
                        <p>
                        @if($detail['ans']>=20)
                            {{ $lang['6'] }} 20, {{ $lang['7'] }} <strong>{{ $lang['8'] }}</strong>.
                        @elseif($detail['ans']<10)
                            {{ $lang['9'] }} 10,{{ $lang['10'] }} <strong>{{ $lang['11'] }}</strong>.
                        @else
                            {{ $lang['5'] }}.
                        @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>