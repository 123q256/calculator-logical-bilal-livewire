<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">   
                <div class="col-span-12 ">
                    <label for="style" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" id="style" name="style">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],
                                $lang['13'],$lang['14'],$lang['15']];
                                $val = ['13.8','9.5','4.8','10.3','5.3','10','8.3','7','9.8','3.5','5.5','9.8','6.8','4.5'];
                                optionsList($val,$name,isset($_POST['style'])?$_POST['style']:'13.3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="weight" class="label">{{ $lang['16'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '1.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lb')">lb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'stone')">stone</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="time" class="label">{{ $lang['17'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="time" id="time" step="any" max="59" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }} ▾</label>
                        <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }}" id="time_unit" class="hidden">
                        <div id="time_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'hrs')">hrs</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['18']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['cal_burned_per_min'] }} kcal</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['19'] }} :</strong></td>
                                    <td class="border-b py-2">{{ $detail['total_cal_burned'] }} kal</td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>