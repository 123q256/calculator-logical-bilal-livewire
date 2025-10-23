<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
      
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6 size_unit ">
                    <label for="size_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <select name="size_unit" id="size_unit" class="input">    
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["6 (15.24 cm)", "8 (20.32 cm)", "10 (25.40 cm)", "12 (30.48 cm)", "14 (35.56 cm)", "16 (40.64 cm)", "18 (45.72 cm)", "
                20 (50.80 cm)", "22 (55.88 cm)", "24 (60.96 cm)", "26 (66.04 cm)", "28 (71.12 cm)", "30 (76.20 cm)", "32 (81.28 cm)", "34 (86.36 cm)", "36 (91.44 cm)", "40 (101.60 cm)", "42 (106.68 cm)", "48 (121.91 cm)", "54 (137.16 cm)", "60 (152.40 cm)"];
                                $val = ["6 (15.24 cm)", "8 (20.32 cm)", "10 (25.40 cm)", "12 (30.48 cm)", "14 (35.56 cm)", "16 (40.64 cm)", "18 (45.72 cm)", "
                20 (50.80 cm)", "22 (55.88 cm)", "24 (60.96 cm)", "26 (66.04 cm)", "28 (71.12 cm)", "30 (76.20 cm)", "32 (81.28 cm)", "34 (86.36 cm)", "36 (91.44 cm)", "40 (101.60 cm)", "42 (106.68 cm)", "48 (121.91 cm)", "54 (137.16 cm)", "60 (152.40 cm)"];
                                optionsList($val,$name,isset(request()->size_unit)?request()->size_unit:'16 (40.64 cm)');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 height">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height'])?$_POST['height']:'120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            @foreach (["cm", "m", "in", "ft", "yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $item }}')"> {{ $item }}</p>
                             @endforeach
                        </div>
                    </div>
                 </div>

               
                <div class="col-span-12 md:col-span-6 lg:col-span-6 quantity">
                    <label for="quantity" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset(request()->quantity)?request()->quantity:'1' }}" />
                        <span class="text-blue input_unit">{{$lang['4']}}</span>
                    </div>
                </div>
                <p class="col-span-12"><strong>{{ $lang['5'] }}</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 width">
                    <label for="concerete_mix_unit" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <select class="input" name="concerete_mix_unit" id="concerete_mix_unit">
                            @php
                            $name = [$lang['7'], $lang['8']];
                            $val = [$lang['7'], $lang['8']];
                            optionsList($val,$name,isset(request()->concerete_mix_unit)?request()->concerete_mix_unit:$lang['7']);
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 density conc_mix_one">
                    <label for="density" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density'])?$_POST['density']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }} ▾</label>
                        <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }}" id="density_unit" class="hidden">
                        <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                            @foreach (["kg/m³", "lb/cu ft", "lb/cu yd", "g/cm³"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('density_unit', '{{ $name }}')"> {{ $name }}</p>
                             @endforeach
                        </div>
                    </div>
                 </div>
            
                <div class="col-span-12 md:col-span-6 lg:col-span-6 conc_mix_two hidden">
                    <label for="concrete_ratio_unit" class="font-s-14 text-blue">{{ $lang['15'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select class="input" name="concrete_ratio_unit" id="concrete_ratio_unit" onchange="mySelection(this)">
                            @php
                                $name = ["1:5:10 (5.0 MPa or 725 psi)", "1:4:8 (7.5 MPa or 1085 psi)", "1:3:6 (10.0 MPa or 1450 psi)", "1:2:4 (15.0 MPa or 2175 psi)", "1:1.5:3 (20.0 MPa or 2900 psi)"];
                                $val = ["1:5:10 (5.0 MPa or 725 psi)", "1:4:8 (7.5 MPa or 1085 psi)", "1:3:6 (10.0 MPa or 1450 psi)", "1:2:4 (15.0 MPa or 2175 psi)", "1:1.5:3 (20.0 MPa or 2900 psi)"];
                                optionsList($val,$name,isset(request()->concrete_ratio_unit)?request()->concrete_ratio_unit:'1:5:10 (5.0 MPa or 725 psi)');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 bag_size conc_mix_one">
                    <label for="bag_size" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bag_size" id="bag_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bag_size'])?$_POST['bag_size']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bag_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bag_size_unit_dropdown')">{{ isset($_POST['bag_size_unit'])?$_POST['bag_size_unit']:'kg' }} ▾</label>
                        <input type="text" name="bag_size_unit" value="{{ isset($_POST['bag_size_unit'])?$_POST['bag_size_unit']:'kg' }}" id="bag_size_unit" class="hidden">
                        <div id="bag_size_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bag_size_unit">
                            @foreach (["kg", "lb"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bag_size_unit', '{{ $name }}')"> {{ $name }}</p>
                             @endforeach
                        </div>
                    </div>
                 </div>
               
                <div class="col-span-12 md:col-span-6 lg:col-span-6 cost">
                    <label for="waste" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="waste" id="waste" class="input" aria-label="input"  value="{{ isset(request()->waste)?request()->waste:'5' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <p class="col-span-12"><strong>{{ $lang['12'] }}</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 cost conc_mix_one">
                    <label for="Cost_bag_mix" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="Cost_bag_mix" id="Cost_bag_mix" class="input" aria-label="input"  value="{{ isset(request()->Cost_bag_mix)?request()->Cost_bag_mix:'10' }}" />
                        <span class="text-blue input_unit">{{$currancy}}/{{$lang['14']}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 conc_mix_two hidden">
                    <label for="Cost_of_cement" class="font-s-14 text-blue">{{ $lang['16'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="Cost_of_cement" id="Cost_of_cement" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['Cost_of_cement'])?$_POST['Cost_of_cement']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="Cost_of_cement_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('Cost_of_cement_unit_dropdown')">{{ isset($_POST['Cost_of_cement_unit'])?$_POST['Cost_of_cement_unit']: $currancy.'cm³' }} ▾</label>
                        <input type="text" name="Cost_of_cement_unit" value="{{ isset($_POST['Cost_of_cement_unit'])?$_POST['Cost_of_cement_unit']:$currancy.'cm³' }}" id="Cost_of_cement_unit" class="hidden">
                        <div id="Cost_of_cement_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="Cost_of_cement_unit">
                            @foreach (["$currancy cm³", "$currancy m³", "$currancy cu ft", "$currancy cu yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('Cost_of_cement_unit', '{{ $name }}')"> {{ $name }}</p>
                             @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 conc_mix_two hidden">
                    <label for="Cost_of_sand" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="Cost_of_sand" id="Cost_of_sand" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['Cost_of_sand'])?$_POST['Cost_of_sand']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="Cost_of_sand_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('Cost_of_sand_unit_dropdown')">{{ isset($_POST['Cost_of_sand_unit'])?$_POST['Cost_of_sand_unit']:$currancy.' '.'m³' }} ▾</label>
                        <input type="text" name="Cost_of_sand_unit" value="{{ isset($_POST['Cost_of_sand_unit'])?$_POST['Cost_of_sand_unit']:$currancy.' '.'m³' }}" id="Cost_of_sand_unit" class="hidden">
                        <div id="Cost_of_sand_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="Cost_of_sand_unit">
                            @foreach (["$currancy cm³", "$currancy m³", "$currancy cu ft", "$currancy cu yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('Cost_of_sand_unit', '{{ $name }}')"> {{ $name }}</p>
                             @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 conc_mix_two hidden">
                    <label for="Cost_of_gravel" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="Cost_of_gravel" id="Cost_of_gravel" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['Cost_of_gravel'])?$_POST['Cost_of_gravel']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="Cost_of_gravel_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('Cost_of_gravel_unit_dropdown')">{{ isset($_POST['Cost_of_gravel_unit'])?$_POST['Cost_of_gravel_unit']: $currancy.' '.'m³' }} ▾</label>
                        <input type="text" name="Cost_of_gravel_unit" value="{{ isset($_POST['Cost_of_gravel_unit'])?$_POST['Cost_of_gravel_unit']: $currancy.' '.'m³' }}" id="Cost_of_gravel_unit" class="hidden">
                        <div id="Cost_of_gravel_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="Cost_of_gravel_unit">
                            @foreach (["$currancy cm³", "$currancy m³", "$currancy cu ft", "$currancy cu yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('Cost_of_gravel_unit', '{{ $name }}')"> {{ $name }}</p>
                             @endforeach
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

    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
               <div class="rounded-lg  flex items-center justify-center">
                 <div class="w-full mt-3">
                    <div class="w-full my-1">
                        <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td width="70%" class="pt-2"><strong>{{ $lang['19'] }} :</strong></td>
                                    <td class="pt-2"> {{round($detail['volume'], 4)}} <span class="font-s-14">{{ $lang['21'] }} </span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="pt-3 pb-2 font-s-20">{{ $lang['20'] }} :</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['22'] }} :</td>
                                    <td class="border-b py-2">{{round($detail['volume'] * 28320, 4)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['23'] }} :</td>
                                    <td class="border-b py-2">{{round($detail['volume'] / 35.315, 4)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['24'] }} :</td>
                                    <td class="border-b py-2">{{round($detail['volume'] * 1728, 4)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['25'] }} :</td>
                                    <td class="border-b py-2">{{round($detail['volume'] * 27, 4)}}</td>
                                </tr>
                                @if (request()->concerete_mix_unit === "I'll get pre-mixed concrete bags")
                                    <tr>
                                        <td class="pt-3"><strong>{{ $lang['26'] }} :</strong></td>
                                        <td class="pt-3"> {{round($detail['weghits'], 4)}} <span class="font-s-14">{{ $lang['35'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2 font-s-20">{{ $lang['27'] }} :</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['28'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['weghits'] / 2.205, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['29'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['weghits'] / 2205, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['30'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['weghits']  / 14, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['31'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['weghits'] / 2000, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['weghits'] / 2240, 4)}}</td>
                                    </tr>
            
                                    <tr>
                                        <td class="border-b  pt-3 pb-2"><strong>{{ $lang['33'] }} :</strong></td>
                                        <td class="border-b  pt-3 pb-2"> {{$detail['bagsz']}} <span class="font-s-14">{{ $lang['34'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2"><strong>{{ $lang['36'] }} :</strong></td>
                                        <td class="py-2"> {{$currancy.' '.round($detail['per_units'], 4)}} <span class="font-s-14">Per {{ $lang['21'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2 font-s-20">{{$lang['37']}} :</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['22'] }} :</td>
                                        <td class="border-b py-2"> {{ round($detail['per_units'] / 28320) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['23'] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['per_units'] / 35.315, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['25'] }} :</td>
                                        <td class="border-b py-2"> {{ round($detail['per_units']  / 27, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['39'] }} :</strong></td>
                                        <td class="border-b py-2"> {{$currancy.' '.round($detail['cost_per_colums'], 4)}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['40'] }} :</strong></td>
                                        <td class="border-b py-2"> {{$currancy.' '.round($detail['total_costz'], 4)}}</span></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="pt-3"><strong>{{ $lang['41'] }} :</strong></td>
                                        <td class="pt-3">  {{ round($detail['total_volume'], 4) }} <span class="font-s-14"> {{ $lang['21'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2 font-s-20">{{$lang['42']}} :</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['22'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['total_volume'] * 28320, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['23'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['total_volume'] / 35.315, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['24'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['total_volume'] * 1728, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['25'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['total_volume'] * 27, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-3"><strong>{{ $lang['43'] }} :</strong></td>
                                        <td class="pt-3">  {{ round($detail['value_cement'], 4) }} <span class="font-s-14"> {{ $lang['21'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2 font-s-20">{{$lang['44']}} :</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['22'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_cement'] * 28320, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['23'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_cement'] / 35.315, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['24'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_cement'] * 1728, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['25'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_cement'] * 27, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-3"><strong>{{ $lang['45'] }} :</strong></td>
                                        <td class="pt-3">  {{ round($detail['value_sand'], 4) }} <span class="font-s-14"> {{ $lang['21'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2 font-s-20">{{$lang['46']}} :</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['22'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_sand'] * 28320, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['23'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_sand'] / 35.315, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['24'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_sand'] * 1728, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['25'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_sand'] * 27, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-3"><strong>{{ $lang['47'] }} :</strong></td>
                                        <td class="pt-3">  {{ round($detail['value_gravel'], 4) }} <span class="font-s-14"> {{ $lang['21'] }} </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2 font-s-20">{{$lang['46']}} :</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['22'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_gravel'] * 28320, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['23'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_gravel'] / 35.315, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['24'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_gravel'] * 1728, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['25'] }} :</td>
                                        <td class="border-b py-2">{{round($detail['value_gravel'] * 27, 4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['39'] }} :</strong></td>
                                        <td class="border-b py-2">  {{ $currancy.' '.round($detail['total_costszz'], 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['40'] }} :</strong></td>
                                        <td class="border-b py-2">  {{ $currancy.' '.round($detail['total_costszz'], 4) }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-[20px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                 </div>
            </div>
        </div>
    </div>


    @endif
</form>
@push('calculatorJS')
    <script>
        var conc_mix_two = document.querySelectorAll('.conc_mix_two');
        var conc_mix_one = document.querySelectorAll('.conc_mix_one');
        document.getElementById('concerete_mix_unit').addEventListener('change',function(){
            var concrete = this.value;
            if(concrete == "{!! $lang['7'] !!}"){
                conc_mix_two.forEach(element => {
                    element.classList.add('hidden');
                    element.classList.remove('d-block');
                });
                conc_mix_one.forEach(element => {
                    element.classList.add('d-block');
                    element.classList.remove('hidden');
                });
            }else if(concrete == "{!! $lang['8'] !!}"){
                conc_mix_two.forEach(element => {
                    element.classList.add('d-block');
                    element.classList.remove('hidden');
                });
                conc_mix_one.forEach(element => {
                    element.classList.add('hidden');
                    element.classList.remove('d-block');
                });
            }
        });
    </script>
@endpush