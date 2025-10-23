@php
    $price_unit=request()->price_unit;
    $price=request()->price;
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-2">
                    
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-270 px-3">
                        <label for="want" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2"> 
                            <select name="want" id="want" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5']];
                                    $val = ['stud','sheet','board','all'];
                                    optionsList($val,$name,isset(request()->want)?request()->want:'stud');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall_end_stud">
                        <label for="wall_end_stud" class="font-s-14 text-blue first_text">
                                {{ $lang['6'] }}
                        :</label>
                        <div class="w-100 py-2"> 
                            <select name="wall_end_stud" id="wall_end_stud" class="input">
                                @php
                                    $name = [$lang['7'],$lang['8'],$lang['9'],$lang['10']];
                                    $val = ['0','2','4','6'];
                                    optionsList($val,$name,isset(request()->wall_end_stud)?request()->wall_end_stud:'2');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall_on">
                        <label for="wall_on" class="font-s-14 text-blue second_text"><?=$lang[11]?>
                        :</label>
                        <div class="w-100 py-2"> 
                            <select name="wall_on" id="wall_on" class="input">
                                @php
                                    $name = [$lang['12'],$lang['13']];
                                    $val = ['subfloor','slab'];
                                    optionsList($val,$name,isset(request()->wall_on)?request()->wall_on:'subfloor');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall-height">
                        <label for="hight" class="font-s-14 text-blue hight_text"><?=$lang[14]?>
                        :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="hight" id="hight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hight'])?$_POST['hight']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="hight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hight_unit_dropdown')">{{ isset($_POST['hight_unit'])?$_POST['hight_unit']:'ft' }} ▾</label>
                            <input type="text" name="hight_unit" value="{{ isset($_POST['hight_unit'])?$_POST['hight_unit']:'ft' }}" id="hight_unit" class="hidden">
                            <div id="hight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hight_unit">
                                @foreach (["cm","in","ft"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('hight_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall-length ">
                        <label for="length" class="font-s-14 text-blue four_text">
                        <?=$lang[15]?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'ft' }} ▾</label>
                            <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'ft' }}" id="length_unit" class="hidden">
                            <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 stud-spacing">
                        <label for="stud_spacing" class="font-s-14 text-blue">{{ $lang['16'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="stud_spacing" id="stud_spacing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['stud_spacing'])?$_POST['stud_spacing']:'16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="stud_spacing_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('stud_spacing_unit_dropdown')">{{ isset($_POST['stud_spacing_unit'])?$_POST['stud_spacing_unit']:'ft' }} ▾</label>
                            <input type="text" name="stud_spacing_unit" value="{{ isset($_POST['stud_spacing_unit'])?$_POST['stud_spacing_unit']:'ft' }}" id="stud_spacing_unit" class="hidden">
                            <div id="stud_spacing_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="stud_spacing_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('stud_spacing_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 rim-joist ">
                        <label for="rim_joist_width" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="rim_joist_width" id="rim_joist_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rim_joist_width'])?$_POST['rim_joist_width']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="rim_joist_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rim_joist_width_unit_dropdown')">{{ isset($_POST['rim_joist_width_unit'])?$_POST['rim_joist_width_unit']:'ft' }} ▾</label>
                            <input type="text" name="rim_joist_width_unit" value="{{ isset($_POST['rim_joist_width_unit'])?$_POST['rim_joist_width_unit']:'ft' }}" id="rim_joist_width_unit" class="hidden">
                            <div id="rim_joist_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rim_joist_width_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('rim_joist_width_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 subfloor ">
                        <label for="subfloor_thickness" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="subfloor_thickness" id="subfloor_thickness" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['subfloor_thickness'])?$_POST['subfloor_thickness']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="subfloor_thickness_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('subfloor_thickness_unit_dropdown')">{{ isset($_POST['subfloor_thickness_unit'])?$_POST['subfloor_thickness_unit']:'ft' }} ▾</label>
                            <input type="text" name="subfloor_thickness_unit" value="{{ isset($_POST['subfloor_thickness_unit'])?$_POST['subfloor_thickness_unit']:'ft' }}" id="subfloor_thickness_unit" class="hidden">
                            <div id="subfloor_thickness_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="subfloor_thickness_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('subfloor_thickness_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 stud-width ">
                        <label for="stud_width" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="stud_width" id="stud_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['stud_width'])?$_POST['stud_width']:'3.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="stud_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('stud_width_unit_dropdown')">{{ isset($_POST['stud_width_unit'])?$_POST['stud_width_unit']:'ft' }} ▾</label>
                            <input type="text" name="stud_width_unit" value="{{ isset($_POST['stud_width_unit'])?$_POST['stud_width_unit']:'ft' }}" id="stud_width_unit" class="hidden">
                            <div id="stud_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="stud_width_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('stud_width_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                  
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3  ">
                        <label for="stud_price" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="stud_price" id="stud_price" class="input" aria-label="input"  value="{{ isset(request()->stud_price)?request()->stud_price:'10' }}" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3  ">
                        <label for="estimated_waste" class="font-s-14 text-blue">{{ $lang['21'] }}:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="estimated_waste" id="estimated_waste" class="input" aria-label="input"  value="{{ isset(request()->estimated_waste)?request()->estimated_waste:'15' }}" />
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
                    <div class="w-full my-2">
                        <div class="w-full md:w-[60%] lg:w-[60%]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[22]?> :</strong></td>
                                    <td class="border-b py-2"><?= $detail['studs'];?> <span class="font-s-16"><?=$lang[23]?></span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[35]?> :</strong></td>
                                    <td class="border-b py-2"><?= $currancy.' '.$detail['total_cost'];?> </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[24]?> :</strong></td>
                                    <td class="border-b py-2"><?= $detail['finished_length_of_studs'];?> <span class="font-s-16"><?=$lang[25]?></span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[26]?> :</strong></td>
                                    <td class="border-b py-2"><?= $detail['wall_area_ft'];?> <span class="font-s-16"><?=$lang[27]?></span></td>
                                </tr>
                                <?php if (request()->want == 'sheet' || request()->want == 'all') { ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[28]?> :</strong></td>
                                        <td class="border-b py-2"><?= $detail['sheets_req'];?> <span class="font-s-16"><?=$lang[19]?></span></td>
                                    </tr>
                                <?php } ?>
                                <?php if (request()->want == 'board' || request()->want == 'all') { ?>  
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[30]?> :</strong></td>
                                        <td class="border-b py-2"><?= $detail['board_footage'];?> <span class="font-s-16"><?=$lang[31]?></span></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <table class="w-full">
                                <tr>
                                    <td colspan="3" class="pb-2 pt-3"><strong><?=$lang[32]?></strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$detail['lumber8'] * 2 ?></strong> <span class="font-s-16"> 8 <?=$lang[33]?></span></td>
                                    <td class="border-b py-2"><strong><?=$detail['lumber10'] * 2 ?></strong> <span class="font-s-16"> 10 <?=$lang[33]?></span></td>
                                    <td class="border-b py-2"><strong><?=$detail['lumber12'] * 2 ?></strong> <span class="font-s-16"> 12 <?=$lang[33]?></span></td>
                                </tr> 
                                <tr>
                                    <td colspan="3" class="pb-2 pt-3"><strong><?=$lang[34]?></strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$detail['lumber8']?></strong> <span class="font-s-16"> 8 <?=$lang[33]?></span></td>
                                    <td class="border-b py-2"><strong><?=$detail['lumber10']?></strong> <span class="font-s-16"> 10 <?=$lang[33]?></span></td>
                                    <td class="border-b py-2"><strong><?=$detail['lumber12']?></strong> <span class="font-s-16"> 12 <?=$lang[33]?></span></td>
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
        var wallOnElements = document.querySelectorAll(".wall_on");
        var rimJoistElements = document.querySelectorAll(".rim-joist");
        var subfloorElements = document.querySelectorAll(".subfloor");
        var studWidthElements = document.querySelectorAll(".stud-width");
        var value = document.querySelector("#want").value;
        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
        }
        if (value == "stud") {
            hideElements(wallOnElements);
            hideElements(rimJoistElements);
            hideElements(subfloorElements);
            hideElements(studWidthElements);
        }

        @if(isset($detail) || isset($error))
            if (value == "stud") {
                hideElements(wallOnElements);
                hideElements(rimJoistElements);
                hideElements(subfloorElements);
                hideElements(studWidthElements);
            } else if (value == "sheet") {
                showElements(wallOnElements);
                showElements(rimJoistElements);
                showElements(subfloorElements);
                hideElements(studWidthElements);
            } else if (value == "board") {
                showElements(studWidthElements);
                hideElements(wallOnElements);
                hideElements(rimJoistElements);
                hideElements(subfloorElements);
            } else if (value == "all") {
                showElements(wallOnElements);
                showElements(rimJoistElements);
                showElements(subfloorElements);
                showElements(studWidthElements);
            }
        @endif
        document.querySelector("#want").addEventListener("change", function() {
            var value = this.value;
            if (value == "stud") {
                hideElements(wallOnElements);
                hideElements(rimJoistElements);
                hideElements(subfloorElements);
                hideElements(studWidthElements);
            } else if (value == "sheet") {
                showElements(wallOnElements);
                showElements(rimJoistElements);
                showElements(subfloorElements);
                hideElements(studWidthElements);
            } else if (value == "board") {
                showElements(studWidthElements);
                hideElements(wallOnElements);
                hideElements(rimJoistElements);
                hideElements(subfloorElements);
            } else if (value == "all") {
                showElements(wallOnElements);
                showElements(rimJoistElements);
                showElements(subfloorElements);
                showElements(studWidthElements);
            }
        });

    </script>
@endpush