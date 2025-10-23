<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="type_unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <select name="type_unit" id="type_unit" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['4'], $lang['5'], $lang['6'], $lang['7'], $lang['8'], $lang['9'],$lang['10'],$lang['11'], $lang['12'],$lang['13'], $lang['14']];
                            $val = [$lang['4'], $lang['5'], $lang['6'], $lang['7'], $lang['8'], $lang['9'],$lang['10'],$lang['11'], $lang['12'],$lang['13'], $lang['14']];
                            optionsList($val,$name,isset($_POST['type_unit'])?$_POST['type_unit']: $lang['4'] );
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'g' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'g' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'dag')">dag</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lb')">lb</p>
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
                    <div class="w-full bg-light-blue rounded-lg p-4 mt-6">
                        <div class="my-4">
                            <div class="text-center">
                                <p class="text-lg font-bold text-[#2845F5]">{{ $lang['3'] }}</p>
                                <p class="text-4xl bg-[#2845F5] text-white px-4 py-2 rounded-lg inline-block my-4">
                                    <strong class="">{{ round($detail['answer']) }}<span class="text-lg"> Cal</span></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>