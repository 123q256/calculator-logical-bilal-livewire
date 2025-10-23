<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
      
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="wall_type" class="font-s-14 text-blue"><?=$lang[2]?></label>
                    <div class="w-full py-2">                                  
                        <select name="wall_type" id="wall_type" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["$lang[3]","$lang[4]"];
                                $val = ["single","double"];
                                optionsList($val,$name,isset($_POST['wall_type'])?$_POST['wall_type']:'single');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="wall_length" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wall_length" id="wall_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_length'])?$_POST['wall_length']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_length_unit_dropdown')">{{ isset($_POST['wall_length_unit'])?$_POST['wall_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="wall_length_unit" value="{{ isset($_POST['wall_length_unit'])?$_POST['wall_length_unit']:'cm' }}" id="wall_length_unit" class="hidden">
                        <div id="wall_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_length_unit">
                            @foreach (["ft","in","cm","mm","dm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wall_length_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="wall_width" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wall_width" id="wall_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_width'])?$_POST['wall_width']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_width_unit_dropdown')">{{ isset($_POST['wall_width_unit'])?$_POST['wall_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="wall_width_unit" value="{{ isset($_POST['wall_width_unit'])?$_POST['wall_width_unit']:'cm' }}" id="wall_width_unit" class="hidden">
                        <div id="wall_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_width_unit">
                            @foreach (["ft","in","cm","mm","dm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wall_width_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="wall_height" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wall_height" id="wall_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_height'])?$_POST['wall_height']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_height_unit_dropdown')">{{ isset($_POST['wall_height_unit'])?$_POST['wall_height_unit']:'cm' }} ▾</label>
                        <input type="text" name="wall_height_unit" value="{{ isset($_POST['wall_height_unit'])?$_POST['wall_height_unit']:'cm' }}" id="wall_height_unit" class="hidden">
                        <div id="wall_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_height_unit">
                            @foreach (["ft","in","cm","mm","dm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wall_height_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
              
              
                <p  class="col-span-12  my-1">{{$lang['8']}}</p>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 px-1">
                    <label for="brick_type" class="font-s-14 text-blue">Type</label>
                    <div class="w-full py-2">                                  
                        <select name="brick_type" id="brick_type" class="input ">
                            @php
                                $name = [$lang[9].' (7 5/8" x 2 1/4")', $lang[10].' (8" x 2 1/4")', $lang[11].' (8" x 2 3/4")', $lang[12].' (9 5/8" x 2 5/8")', $lang[13].' (11 5/8" x 1 5/8")', $lang[14].' (11 5/8" x 2 1/4")', $lang[15].' (11 5/8" x 2 1/4")', $lang[16]];
                                $val = ["7.625x3.625","8x2.25","8x2.75","9.625x2.625","11.625x1.625","11.625x2.25","11.625x3.625","1"];
                                optionsList($val,$name,isset($_POST['brick_type'])?$_POST['brick_type']:'single');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="brick_wastage" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                    <div class="w-full py-2 relative"> 
                        <input type="number" step="any" name="brick_wastage" id="brick_wastage" class="input" aria-label="input"  value="{{ isset($_POST['brick_wastage'])?$_POST['brick_wastage']: '24'}}" />
                        <span class="input_unit text-blue">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mortar_joint_thickness" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="mortar_joint_thickness" id="mortar_joint_thickness" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mortar_joint_thickness'])?$_POST['mortar_joint_thickness']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mortar_joint_thickness_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mortar_joint_thickness_unit_dropdown')">{{ isset($_POST['mortar_joint_thickness_unit'])?$_POST['mortar_joint_thickness_unit']:'cm' }} ▾</label>
                        <input type="text" name="mortar_joint_thickness_unit" value="{{ isset($_POST['mortar_joint_thickness_unit'])?$_POST['mortar_joint_thickness_unit']:'cm' }}" id="mortar_joint_thickness_unit" class="hidden">
                        <div id="mortar_joint_thickness_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mortar_joint_thickness_unit">
                            @foreach (["in","cm","mm"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('mortar_joint_thickness_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 custom hidden">
                    <label for="brick_length" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="brick_length" id="brick_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['brick_length'])?$_POST['brick_length']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="brick_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('brick_length_unit_dropdown')">{{ isset($_POST['brick_length_unit'])?$_POST['brick_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="brick_length_unit" value="{{ isset($_POST['brick_length_unit'])?$_POST['brick_length_unit']:'cm' }}" id="brick_length_unit" class="hidden">
                        <div id="brick_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="brick_length_unit">
                            @foreach (["ft","in","cm","mm","dm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('brick_length_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 custom hidden">
                    <label for="brick_width" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="brick_width" id="brick_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['brick_width'])?$_POST['brick_width']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="brick_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('brick_width_unit_dropdown')">{{ isset($_POST['brick_width_unit'])?$_POST['brick_width_unit']:'mm' }} ▾</label>
                        <input type="text" name="brick_width_unit" value="{{ isset($_POST['brick_width_unit'])?$_POST['brick_width_unit']:'mm' }}" id="brick_width_unit" class="hidden">
                        <div id="brick_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="brick_width_unit">
                            @foreach (["ft","in","cm","mm","dm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('brick_width_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 custom hidden">
                    <label for="brick_height" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="brick_height" id="brick_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['brick_height'])?$_POST['brick_height']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="brick_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('brick_height_unit_dropdown')">{{ isset($_POST['brick_height_unit'])?$_POST['brick_height_unit']:'mm' }} ▾</label>
                        <input type="text" name="brick_height_unit" value="{{ isset($_POST['brick_height_unit'])?$_POST['brick_height_unit']:'mm' }}" id="brick_height_unit" class="hidden">
                        <div id="brick_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="brick_height_unit">
                            @foreach (["ft","in","cm","mm","dm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('brick_height_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
              
               

                <p class="col-span-12  my-1">{{$lang['19']}}</p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 px-1">
                    <label for="with_motar" class="font-s-14 text-blue"><?=$lang[20]?>:</label>
                    <div class="w-full py-2">                                  
                        <select name="with_motar" id="with_motar" class="input ">
                            @php
                                $name = ["$lang[21]","$lang[22]"];
                                $val = ["no","yes"];
                                optionsList($val,$name,isset($_POST['with_motar'])?$_POST['with_motar']:'no');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 yes hidden">
                    <label for="wet_volume" class="font-s-14 text-blue">{{ $lang['23'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wet_volume" id="wet_volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wet_volume'])?$_POST['wet_volume']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wet_volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wet_volume_unit_dropdown')">{{ isset($_POST['wet_volume_unit'])?$_POST['wet_volume_unit']:'mm' }} ▾</label>
                        <input type="text" name="wet_volume_unit" value="{{ isset($_POST['wet_volume_unit'])?$_POST['wet_volume_unit']:'mm' }}" id="wet_volume_unit" class="hidden">
                        <div id="wet_volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wet_volume_unit">
                            @foreach (["m³","cm³","cu ft","cu yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wet_volume_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                
                 
                <div class="col-span-12 md:col-span-6 lg:col-span-6 yes hidden">
                    <label for="mortar_wastage" class="font-s-14 text-blue">{{ $lang['24'] }}:</label>
                    <div class="w-full py-2 -relative"> 
                        <input type="number" step="any" name="mortar_wastage" id="mortar_wastage" class="input" aria-label="input"  value="{{ isset($_POST['mortar_wastage'])?$_POST['mortar_wastage']: '24'}}" />
                        <span class="input_unit text-blue">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 px-1 yes hidden">
                    <label for="mortar_ratio" class="font-s-14 text-blue"><?=$lang[25]?></label>
                    <div class="w-full py-2">                                  
                        <select name="mortar_ratio" id="mortar_ratio" class="input ">
                            @php
                                $name = ["1:5 (".$lang[26].")","1:6 (".$lang[27].")","1:4 (".$lang[28].")","1:3 (".$lang[29].")"];
                                $val = ["1:5","1:6","1:4","1:3"];
                                optionsList($val,$name,isset($_POST['mortar_ratio'])?$_POST['mortar_ratio']:'1:5');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 yes hidden">
                    <label for="bag_size" class="font-s-14 text-blue">{{ $lang['30'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bag_size" id="bag_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bag_size'])?$_POST['bag_size']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bag_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bag_size_unit_dropdown')">{{ isset($_POST['bag_size_unit'])?$_POST['bag_size_unit']:'mm' }} ▾</label>
                        <input type="text" name="bag_size_unit" value="{{ isset($_POST['bag_size_unit'])?$_POST['bag_size_unit']:'mm' }}" id="bag_size_unit" class="hidden">
                        <div id="bag_size_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bag_size_unit">
                            @foreach (["Kg","g","lb","t","stone"]  as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bag_size_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
               
                <p class="col-span-12  my-1">{{$lang['31']}}</p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="price_per_brick" class="font-s-14 text-blue">{{ $lang['32'] }}:</label>
                    <div class="w-full py-2 relative"> 
                        <input type="number" step="any" name="price_per_brick" id="price_per_brick" class="input" aria-label="input"  value="{{ isset($_POST['price_per_brick'])?$_POST['price_per_brick']: '24'}}" />
                        <span class="input_unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 yes hidden">
                    <label for="price_of_cement" class="font-s-14 text-blue">{{ $lang['33'] }}:</label>
                    <div class="w-full py-2 relative"> 
                        <input type="number" step="any" name="price_of_cement" id="price_of_cement" class="input" aria-label="input"  value="{{ isset($_POST['price_of_cement'])?$_POST['price_of_cement']: '24'}}" />
                        <span class="input_unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 yes hidden">
                    <label for="price_sand_per_volume" class="font-s-14 text-blue">{{ $lang['34'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="price_sand_per_volume" id="price_sand_per_volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price_sand_per_volume'])?$_POST['price_sand_per_volume']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="price_sand_volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_sand_volume_unit_dropdown')">{{ isset($_POST['price_sand_volume_unit'])?$_POST['price_sand_volume_unit']:'mm' }} ▾</label>
                        <input type="text" name="price_sand_volume_unit" value="{{ isset($_POST['price_sand_volume_unit'])?$_POST['price_sand_volume_unit']:'mm' }}" id="price_sand_volume_unit" class="hidden">
                        <div id="price_sand_volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_sand_volume_unit">
                            @foreach (["m³","cm³","cu ft","cu yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_sand_volume_unit', '{{$currancy.' '.$item}}')"> {{$currancy.' '.$item}}</p>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result mt-5">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full ">
                    <div class="w-full">
                        <div class="w-full md:w-[70%] lg:w-[70%] font-s-18">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[36]?> :</strong></td>
                                    <td class="border-b py-2"><?=$detail['no_of_bricks_with_wastage']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[40]?> :</strong></td>
                                    <td class="border-b py-2"><?=$detail['wall_area']?> m²
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[41]?> :</strong></td>
                                    <td class="border-b py-2">
                                    <?=$detail['no_of_bricks']?>
                                    </td>
                                </tr>
                                <?php if(isset($detail['dry_volume']) && isset($detail['dry_volume_with_wastage']) && isset($detail['volume_of_cement']) && isset($detail['number_of_bags']) && isset($detail['volume_of_sand'])) {?>
                                    <tr>
                                        <td colspan="2" class="pb-2 pt-3">
                                           <strong> <?=$lang[53]?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang[43]?> :</td>
                                        <td class="border-b py-2">
                                        <?=$detail['dry_volume']?> m³
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang[44]?> :</td>
                                        <td class="border-b py-2">
                                        <?=$detail['dry_volume_with_wastage']?> m³
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang[45]?> :</td>
                                        <td class="border-b py-2">
                                        <?=$detail['volume_of_cement']?> m³
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang[46]?> :</td>
                                        <td class="border-b py-2">
                                        <?=$detail['number_of_bags']?> <?=$lang[48]?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang[47]?> :</td>
                                        <td class="border-b py-2">
                                        <?=$detail['volume_of_sand']?> m³
                                        </td>
                                    </tr>
                                <?php }?>
                                <tr>
                                    <td colspan="2" class="pb-2 pt-3"><strong><?=$lang[54]?></strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang[49]?> :</td>
                                    <td class="border-b py-2">
                                    <?=$currancy.' '. $detail['cost_of_bricks']?>
                                    </td>
                                </tr>
                                <?php if(isset($detail['mortar_cost']) && isset($detail['total_cost'])){ ?>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang[50]?> :</td>
                                        <td class="border-b py-2">
                                        <?=$currancy.' '. $detail['mortar_cost']?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-2 pb-3"><?=$lang[51]?> :</td>
                                        <td class="pt-2 pb-3">
                                        <?=$currancy.' '. $detail['total_cost']?>
                                        </td>
                                    </tr>
                                <?php }?>
                                    
                            </table>
                        </div>
                    </div>
                    <div class="w-full text-center mt-[20px]">
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
        var custom = document.querySelectorAll('.custom');
        var yes = document.querySelectorAll('.yes');
        document.getElementById('brick_type').addEventListener('change',function(){
            var brick = this.value;
            if(brick == '1'){
                custom.forEach(el => {
                    el.style.display = "block";
                });
            }else{
                custom.forEach(el => {
                    el.style.display = "none";
                });
            }
        });
        document.getElementById('with_motar').addEventListener('change',function(){
            var motar = this.value;
            if(motar == 'yes'){
                yes.forEach(el => {
                    el.style.display = "block";
                });
            }else{
                yes.forEach(el => {
                    el.style.display = "none";
                });
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>