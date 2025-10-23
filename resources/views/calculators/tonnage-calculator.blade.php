<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="material" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="material" id="material" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'], $lang['3'], $lang['4'], $lang['5'], $lang['6'], $lang['7'], $lang['8'], $lang['9'],$lang['10'],$lang['11'], $lang['12'],$lang['13'], $lang['14']
                            , $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['20'], $lang['21'], $lang['22']];
                            $val = ["2243","1466","1710","1625","721","1554","1872","1320","1602","1476","1720","1710","1642","2643","1482","1398","1788","1426","1602","1762","1682"];
                            optionsList($val,$name,isset($_POST['material'])?$_POST['material']:'1476');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="unit_weight" class="label">{{ $lang['23'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="unit_weight" id="unit_weight" class="input" aria-label="input"  value="{{ isset($_POST['unit_weight'])?$_POST['unit_weight']:'1476' }}" />
                    <span class="text-blue input_unit">kg/m³</span>
                </div>
            </div>
            <p class="col-span-12"><strong>{{$lang['24']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="length" class="label">{{ $lang['25'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_units_dropdown')">{{ isset($_POST['length_units'])?$_POST['length_units']:'m' }} ▾</label>
                    <input type="text" name="length_units" value="{{ isset($_POST['length_units'])?$_POST['length_units']:'m' }}" id="length_units" class="hidden">
                    <div id="length_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_units">
                        @foreach (["cm","m","in","ft","yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="width" class="label">{{ $lang['26'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_units_dropdown')">{{ isset($_POST['width_units'])?$_POST['width_units']:'m' }} ▾</label>
                    <input type="text" name="width_units" value="{{ isset($_POST['width_units'])?$_POST['width_units']:'m' }}" id="width_units" class="hidden">
                    <div id="width_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                        @foreach (["cm","m","in","ft","yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="depth" class="label">{{ $lang['27'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth']) ? $_POST['depth'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="depth_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth_units_dropdown')">{{ isset($_POST['depth_units'])?$_POST['depth_units']:'m' }} ▾</label>
                    <input type="text" name="depth_units" value="{{ isset($_POST['depth_units'])?$_POST['depth_units']:'m' }}" id="depth_units" class="hidden">
                    <div id="depth_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="depth_units">
                        @foreach (["cm","m","in","ft","yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('depth_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>
         
            <p class="col-span-12"><strong>{{$lang['28']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="price_per" class="label">{{ $lang['29'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="price_per" id="price_per" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price_per']) ? $_POST['price_per'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="price_per_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_per_units_dropdown')">{{ isset($_POST['price_per_units'])?$_POST['price_per_units']:'kg' }} ▾</label>
                    <input type="text" name="price_per_units" value="{{ isset($_POST['price_per_units'])?$_POST['price_per_units']:'kg' }}" id="price_per_units" class="hidden">
                    <div id="price_per_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_per_units">
                        @foreach (["kg","t","lb","st"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_per_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="wastage" class="label">{{ $lang['30'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="wastage" id="wastage" class="input" aria-label="input"  value="{{ isset($_POST['wastage'])?$_POST['wastage']:'4' }}" />
                    <span class="text-blue input_unit">%</span>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['31']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{ $detail['tonnage'] }} t
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['32']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['area']}} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['33']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['volume']}} m³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['34']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['weight_needed']}} t</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['35']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$currancy.$detail['total_cost']}} </td>
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
         document.getElementById('material').addEventListener('change',function(){
             var selected = this.value;
            var densityInputs = document.getElementById('unit_weight');
            densityInputs.value = selected;
        });
    </script>
@endpush