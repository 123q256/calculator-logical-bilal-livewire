<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="rock_type" class="label">{{ $lang['rock_type'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" name="rock_type" id="rock_type">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['s_r_r'],$lang['b_g'],$lang['c_p_g'],$lang['c_r_r'],$lang['c_b'],$lang['c_g_g'],$lang['c_a'],$lang['c_g'],$lang['c_s'],$lang['cr_r_r'],$lang['d_g'],$lang['grnt'],$lang['i_c_g'],$lang['p_g'],$lang['p_r_r'],$lang['qrtz'],$lang['r_g'],$lang['s_g_g'],$lang['w_m_c'],$lang['custom']];
							$val = ["1425","1483","1545","1314","1670","2098","721","1320","1602","1522","1865","2650","1506","1788","1490","2700","1346","1505","1430","custom"];
                            optionsList($val,$name,isset($_POST['rock_type'])?$_POST['rock_type']:'1430');
                        @endphp
                    </select>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="density" class="label">{{ $lang['density'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density']) ? $_POST['density'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'t/m³' }} ▾</label>
                    <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'t/m³' }}" id="density_unit" class="hidden">
                    <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/m³')">kg/m³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 't/m³')">t/m³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/cm³')">g/cm³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/cu in')">lb/cu in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/cu ft')">lb/cu ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/cu yd')">lb/cu yd</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="length" class="label">{{ $lang['length'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                    <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                    <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">miles (mi)</p>

                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="width" class="label">{{ $lang['width'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'km' }} ▾</label>
                    <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'km' }}" id="width_unit" class="hidden">
                    <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mi')">miles (mi)</p>

                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="depth" class="label">{{ $lang['depth'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth']) ? $_POST['depth'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth_unit_dropdown')">{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'km' }} ▾</label>
                    <input type="text" name="depth_unit" value="{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'km' }}" id="depth_unit" class="hidden">
                    <div id="depth_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="depth_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'yd')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', 'mi')">miles (mi)</p>

                    </div>
                 </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="wastage" class="label">{{ $lang['wastage'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="wastage" id="wastage" class="input" aria-label="input"  value="{{ isset($_POST['wastage'])?$_POST['wastage']:'5' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="price" class="label">{{ $lang['mass_price'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price']) ? $_POST['price'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:$currancy.'/lb' }} ▾</label>
                    <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:$currancy.'/lb' }}" id="price_unit" class="hidden">
                    <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                        <input type="hidden" name="currancy" value="{{$currancy}}">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_unit', '{{$currancy}}/kg')">{{$currancy}}/kg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_unit', '{{$currancy}}/t')">{{$currancy}}/t</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_unit', '{{$currancy}}/lb')">{{$currancy}}/lb</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_unit', '{{$currancy}}/stone')">{{$currancy}}/stone</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_unit', '{{$currancy}}/us_ton')">{{$currancy}}/us_ton</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_unit', '{{$currancy}}/long_ton')">{{$currancy}}/long_ton</p>
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
                        <div class="w-full mt-4">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                    <div class="bg-[#ffffff] p-3 rounded-lg ">
                                        <p class="text-[20px]"><strong>{{ $lang['volume']}}</strong></p>
                                        <p class="text-25px mt-1">
                                            <strong class="text-green-700 text-[24px]">{{$detail['volume'] }}</strong>
                                            <span class="text-[23px]">m³</span>
                                        </p>
                                    </div>
                                </div>
                                    @php
                                    @endphp
                                    @foreach($detail['volume_units'] as $key => $value)
                                        @php 
                                            $value = explode('@@@', $value) ;
                                            $count = count($detail['volume_units'])-1;
                                        @endphp
                                        <div class="col-span-6 md:col-span-2 lg:col-span-2 {{($key !=$count ? 'border-r':'')}}">
                                            <p  class="pb-1"><strong>{{$value[0]}}</strong></p>
                                            <p>{{$value[1]}}</p>
                                        </div>
                                    @endforeach
                            </div>
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                    <div class="bg-[#ffffff] p-3 rounded-lg ">
                                        <p class="text-[20px]"><strong>{{ $lang['weight']}}</strong></p>
                                        <p class=" mt-1">
                                            <strong class="text-green-700 text-[24px]">{{$detail['weight'] }}</strong>
                                            <span class="text-[18px]">ton</span>
                                        </p>
                                    </div>
                                </div>
                                @foreach($detail['weight_units'] as $key => $value)
                                @php 
                                    $value = explode('@@@', $value);
                                    $count = count($detail['weight_units'])-1; 
                                @endphp
                                    <div class="col-span-6 md:col-span-2 lg:col-span-2  {{($key !=$count ? 'border-r':'')}}">
                                        <p  class="pb-1"><strong>{{$value[0]}}</strong></p>
                                        <p>{{$value[1]}}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                    <div class="bg-[#ffffff] p-3 rounded-lg ">
                                        <p class="text-[20px]"><strong>{{ $lang['area']}}</strong></p>
                                        <p class=" mt-1">
                                            <strong class="text-green-700 text-[24px]">{{$detail['area'] }}</strong>
                                            <span class="text-[18px]">m²</span>
                                        </p>
                                    </div>
                                </div>
                                    @foreach($detail['area_units'] as $key => $value)
                                    @php 
                                        $value = explode('@@@', $value);
                                        $count = count($detail['area_units'])-1; 
                                    @endphp
                                        <div class="col-span-6 md:col-span-2 lg:col-span-2 {{($key !=$count ? 'border-end':'')}}">
                                            <p  class="pb-1"><strong>{{$value[0]}}</strong></p>
                                            <p>{{$value[1]}}</p>
                                        </div>
                                    @endforeach
                            </div>
                            @if(!empty($detail['price_v']))
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-12 md:col-span-3 lg:col-span-4">
                                        <div class="bg-white p-2 rounded-lg">
                                            <p class="text-[20px]"><strong>{{ $lang['v_price']}}</strong></p>
                                            <p class=" mt-1">
                                                <strong class="text-green-700 text-[24px]">{{$detail['price_v'] }}</strong>
                                                <span class="font-s-20">{{$currancy}}/m³</span>
                                            </p>
                                        </div>
                                    </div>
                                        @foreach($detail['price_v_units'] as $key => $value)
                                        @php 
                                            $value = explode('@@@', $value);
                                            $count = count($detail['price_v_units'])-1; 
                                        @endphp
                                            <div class="col-span-6 md:col-span-2 lg:col-span-2 {{($key !=$count ? 'border-r':'')}}">
                                                <p  class="pb-1"><strong>{{$value[0]}}</strong></p>
                                                <p>{{$value[1]}}</p>
                                            </div>
                                        @endforeach
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <p class="text-[20px]"><strong>{{ $lang['cost']}}</strong></p>
                                    <p class=" mt-1">
                                        <strong class="text-green-700 text-[25px]">{{$currancy}} {{$detail['total_cost'] }}</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('rock_type').addEventListener('change',function(){
            var densityInputs = document.querySelectorAll('.density');
            var selected = this.value;
            if (selected === 'custom') {
                densityInputs.forEach(function(input) {
                    input.value = '';
                    input.removeAttribute('disabled');
                });
            } else {
                densityInputs.forEach(function(input) {
                    input.value = selected;
                });
            }
        });
    </script>
@endpush