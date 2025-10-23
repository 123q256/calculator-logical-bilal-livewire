<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
              
                
   
                <div class="space-y-2">
                    <label for="volume" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="volume" id="volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_unit_dropdown')">{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'mL' }} ▾</label>
                        <input type="text" name="volume_unit" value="{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'mL' }}" id="volume_unit" class="hidden">
                        <div id="volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'mL')">mL ({!! $lang[2] !!})</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'L')">L ({!! $lang[3] !!})</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'uL')">uL ({!! $lang[4] !!})</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="molarity" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="molarity" id="molarity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['molarity'])?$_POST['molarity']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="molarity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('molarity_unit_dropdown')">{{ isset($_POST['molarity_unit'])?$_POST['molarity_unit']:'M' }} ▾</label>
                        <input type="text" name="molarity_unit" value="{{ isset($_POST['molarity_unit'])?$_POST['molarity_unit']:'M' }}" id="molarity_unit" class="hidden">
                        <div id="molarity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molarity_unit', 'M')">M (mol/lit)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molarity_unit', 'mM')">mM (mmol/L)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molarity_unit', 'uM')">uM (µmol/L)</p>
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
                    <div class="rounded-lg mt-3 flex items-center justify-center">
                    <div class="w-full">
                        <div class="col-12 text-center">
                            <p><strong class="text-[18px]">{!! $lang[6] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[32px]" style="font-size: 32px">{!! round($detail['answer'], 2) !!}</strong></p>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>