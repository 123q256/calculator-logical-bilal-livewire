<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'kg' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'kg' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'oz')">ounces (oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                       
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="condition" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <select name="condition" id="condition" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Neutered adult", "Non-neutered adult", "Weight loss", "Weight gain", "0-4 months old kitten ", "4 months to adult cat"];
                            $val = ["Neutered adult", "Non-neutered adult", "Weight loss", "Weight gain", "0-4 months old kitten ", "4 months to adult cat"];
                            optionsList($val,$name,isset(request()->condition)?request()->condition:'Neutered adult');
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
                    <div class="w-full bg-light-blue rounded-lg p-4 mt-6">
                        <div class="w-full">
                            <div class="flex flex-col md:flex-row md:justify-between md:w-1/2 mx-auto">
                                <div class="text-center md:text-left">
                                    <p><strong>{{ $lang['3'] }}</strong></p>
                                    <p>
                                        <strong class="text-[#119154] text-4xl">{{ round($detail['resting_energy'], 2) }}</strong>
                                        <span class="text-lg">kcal</span>
                                    </p>
                                </div>
                                <div class="hidden md:block border-r mx-4"></div>
                                <div class="text-center md:text-left">
                                    <p><strong>{{ $lang['4'] }}</strong></p>
                                    <p>
                                        <strong class="text-[#119154] text-4xl">{{ round($detail['maintenance_energy'], 2) }}</strong>
                                        <span class="text-lg">kcal</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    @endisset
</form>