<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="gender" class="font-s-14 text-blue">{{ $lang['gen'] }}:</label>
                    <select name="gender" id="gender" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['male'],$lang['female']];
                            $val = ["1","0"];
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'1');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="age" class="font-s-14 text-blue">{{ $lang['age'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="age" id="age" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['age'])?$_POST['age']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="age_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('age_unit_dropdown')">{{ isset($_POST['age_unit'])?$_POST['age_unit']:'years' }} ▾</label>
                        <input type="text" name="age_unit" value="{{ isset($_POST['age_unit'])?$_POST['age_unit']:'years' }}" id="age_unit" class="hidden">
                        <div id="age_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'days')">days</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'weeks')">weeks</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'months')">months</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'years')">years</p>
                        </div>
                    </div>
                    </div>
                    <div class="space-y-2">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['height'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_unit_dropdown')">{{ isset($_POST['w_unit'])?$_POST['w_unit']:'kg' }} ▾</label>
                        <input type="text" name="w_unit" value="{{ isset($_POST['w_unit'])?$_POST['w_unit']:'kg' }}" id="w_unit" class="hidden">
                        <div id="w_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%]mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'oz')">ounces (oz)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'lbs')">pounds (lbs)</p>
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
                    <div class="w-full p-3 rounded-lg mt-3">
                        <div class="w-full">
                            <div class="bg-[#F6FAFC]  text-black border rounded-lg p-3">
                                {{ $lang[2] }} = <span class=" text-2xl font-bold">{{ $detail['first_ans'] }}</span> {{ $lang[3] }}
                            </div>
                            <p class="lg:text-md mt-2" id="line">{!! $detail['line'] !!}</p>
                            <div class="mt-3">
                                <img src="{{ url('images/'.$detail['image'].'.png') }}" alt="Growth Chart" class="w-full object-cover" style="height: 116px;object-fit: fill;">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    @endisset
</form>