@php
    $bed=request()->bed;
    $grid=request()->grid;
    $hedgerows=request()->hedgerows;
    $want=request()->want;
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12">
                    <div class="grid grid-cols-12  mt-3  gap-4">
                    <div class="col-span-6">
                        <div class="grid grid-cols-1  mt-3  gap-4">
                        <div class="col-span-12">
                            <label for="bed" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select name="bed" id="bed" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['2'],$lang['3']];
                                        $val = ['grid','hedgerow'];
                                        optionsList($val,$name,isset($_POST['bed'])?$_POST['bed']:'3');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 grid1">
                            <label for="grid" class="font-s-14 text-blue grid_text">{{ $lang['4'] }}
                            :</label>
                            <div class="w-100 py-2"> 
                                <select name="grid" id="grid" class="input">
                                    @php
                                        $name = [$lang['5'],$lang['6'],$lang['7']];
                                        $val = ['square','rectangular','triangular'];
                                        optionsList($val,$name,isset($_POST['grid'])?$_POST['grid']:'3');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 hedgerows">
                            <label for="hedgerows" class="font-s-14 text-blue hedgerows_text">{{ $lang['8'] }}
                            :</label>
                            <div class="w-100 py-2"> 
                                <select name="hedgerows" id="hedgerows" class="input">
                                    @php
                                        $name = [$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']];
                                        $val = ['1','2','3','4','5'];
                                        optionsList($val,$name,isset($_POST['hedgerows'])?$_POST['hedgerows']:'3');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-span-6">
                            <img src="{{asset('images/plant-spacing-img/square.png')}}" alt="ShapeImage" class="max-width my-lg-2 set_img" width="300px" height="220px">
                    </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 length">
                    <label for="length" class="font-s-14 text-blue length_text">
                        {{ $lang['14'] }}
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'m' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'m' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 width ">
                    <label for="width" class="font-s-14 text-blue width_text">
                        {{ $lang['15'] }}
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'m' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'m' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 want ">
                    <label for="want" class="font-s-14 text-blue ">
                        {{ $lang['16'] }}
                    :</label>
                    <div class="w-100 py-2"> 
                        <select name="want" id="want" class="input">
                            @php
                                $name = [$lang['17'],$lang['18']];
                                $val = ['amount','arrange'];
                                optionsList($val,$name,isset($_POST['want'])?$_POST['want']:'3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 borderr ">
                    <label for="border" class="font-s-14 text-blue border_text">
                        {{ $lang['19'] }}
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="border" id="border" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['border']) ? $_POST['border'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="border_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('border_unit_dropdown')">{{ isset($_POST['border_unit'])?$_POST['border_unit']:'m' }} ▾</label>
                        <input type="text" name="border_unit" value="{{ isset($_POST['border_unit'])?$_POST['border_unit']:'m' }}" id="border_unit" class="hidden">
                        <div id="border_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="border_unit">
                            @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('border_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hedge ">
                    <label for="hedge" class="font-s-14 text-blue hedge_text">
                        {{ $lang['20'] }}
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="hedge" id="hedge" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hedge']) ? $_POST['hedge'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="hedge_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hedge_unit_dropdown')">{{ isset($_POST['hedge_unit'])?$_POST['hedge_unit']:'m' }} ▾</label>
                        <input type="text" name="hedge_unit" value="{{ isset($_POST['hedge_unit'])?$_POST['hedge_unit']:'m' }}" id="hedge_unit" class="hidden">
                        <div id="hedge_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hedge_unit">
                            @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('hedge_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 plant_spacing ">
                    <label for="plant_spacing" class="font-s-14 text-blue ">
                        {{ $lang['21'] }}
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="plant_spacing" id="plant_spacing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['plant_spacing']) ? $_POST['plant_spacing'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="plant_spacing_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('plant_spacing_unit_dropdown')">{{ isset($_POST['plant_spacing_unit'])?$_POST['plant_spacing_unit']:'m' }} ▾</label>
                        <input type="text" name="plant_spacing_unit" value="{{ isset($_POST['plant_spacing_unit'])?$_POST['plant_spacing_unit']:'m' }}" id="plant_spacing_unit" class="hidden">
                        <div id="plant_spacing_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="plant_spacing_unit">
                            @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('plant_spacing_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 row_spacing ">
                    <label for="row_spacing" class="font-s-14 text-blue row_spacing_text">
                        {{ $lang['22'] }}
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="row_spacing" id="row_spacing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['row_spacing']) ? $_POST['row_spacing'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="row_spacing_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('row_spacing_unit_dropdown')">{{ isset($_POST['row_spacing_unit'])?$_POST['row_spacing_unit']:'m' }} ▾</label>
                        <input type="text" name="row_spacing_unit" value="{{ isset($_POST['row_spacing_unit'])?$_POST['row_spacing_unit']:'m' }}" id="row_spacing_unit" class="hidden">
                        <div id="row_spacing_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="row_spacing_unit">
                            @foreach (["cm","m","in","ft","yd","mm","km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('row_spacing_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 total_plants ">
                    <label for="total_plants" class="font-s-14 text-blue total_plants_text">
                        {{ $lang['23'] }}
                    :</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="total_plants" id="total_plants" class="input" aria-label="input"  value="{{ isset($_POST['total_plants'])?$_POST['total_plants']:'50' }}" />
                        
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 total_rows ">
                    <label for="total_rows" class="font-s-14 text-blue total_rows_text">
                        {{ $lang['24'] }}
                    :</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="total_rows" id="total_rows" class="input" aria-label="input"  value="{{ isset($_POST['total_rows'])?$_POST['total_rows']:'110' }}" />
                        
                    </div>
                </div>
                <p class="col-span-12 ">{{$lang['39']}}</p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 no_of_plant ">
                    <label for="no_of_plant" class="font-s-14 text-blue no_of_plant_text">
                        {{ $lang['40'] }}
                    :</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="no_of_plant" id="no_of_plant" class="input" aria-label="input"  value="{{ isset($_POST['no_of_plant'])?$_POST['no_of_plant']:'5' }}" />
                        
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 plant_price ">
                    <label for="plant_price" class="font-s-14 text-blue plant_price_text">
                        {{ $lang['41'] }}
                    :</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="plant_price" id="plant_price" class="input" aria-label="input"  value="{{ isset($_POST['plant_price'])?$_POST['plant_price']:'110' }}" />
                        <spn class="text-blue input_unit">{{$currancy}}</spn>
                    </div>
                </div>

        </div>
            @if ($type=='calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
    </div>
    @isset($detail)


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full my-1">
                        <?php if($bed == 'grid'){?>
                            <?php if($grid == 'square'){?>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-12  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[25]?> :</strong></span>
                                        <span><?= $detail['plants'];?></span>
                                    </div>
                                </div>
                              <p class="mt-2"> 
                                <?=$lang[28]?> <?= $detail['plant_cols'];?> x <?= $detail['plant_rows'];?> <?=$lang[29]?>
                              </p>
                            <?php }elseif ($grid == 'rectangular') {?>
                              <?php if($want == 'amount'){?>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-12  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[25]?> :</strong></span>
                                        <span><?= $detail['plants'];?></span>
                                    </div>
                                </div>
                                <p class="mt-2">
                                  <?=$lang[30]?> <?= $detail['plant_cols'];?> x <?= $detail['plant_rows'];?> <?=$lang[31]?>
                                </p>
                              <?php }elseif($want == 'arrange'){?>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[26]?> :</strong></span>
                                        <span><?= $detail['cols'];?></span>
                                    </div> 
                                </div>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[32]?> :</strong></span>
                                        <span><?= $detail['row_space'];?>
                                            <span>m</span>
                                        </span>
                                    </div>
                                </div> 
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[27]?> :</strong></span>
                                        <span><?= $detail['plant_spacing'];?>
                                            <span>m</span>
                                        </span>
                                    </div>
                                </div>
                              <?php } ?>
                            <?php }elseif ( $grid == 'triangular') {?>  
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[25]?> :</strong></span>
                                        <span><?= $detail['total_plants'];?></span>
                                    </div>
                                </div>
                                <p class="mt-2">
                                    <?=$lang[33]?> <?= $detail['total_rows'];?> <?=$lang[34]?> <?= $detail['row_spacing'];?> m <?=$lang[35]?> <?= $detail['plant_spacing_m'];?> m <?=$lang[36]?> <?= $detail['odd_num_plant'];?> <?=$lang[37]?> <?= $detail['evn_num_plant'];?> <?=$lang[38]?>
                                </p>
                            <?php } ?>
                        <?php }else {?>  
                            <?php if($want == 'amount'){?>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[25]?> :</strong></span>
                                        <span><?= $detail['total_plants'];?></span>
                                    </div>
                                </div>
                            <?php }elseif($want == 'arrange'){?>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[26]?> :</strong></span>
                                        <span><?= $detail['plant_per_row'];?></span>
                                    </div> 
                                </div>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="flex col-span-6  border-b py-2 text-[18px]">
                                        <span><strong><?=$lang[27]?> :</strong></span>
                                        <span><?= $detail['plant_space'];?>
                                            <span>m</span>
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="flex col-span-6 text-[18px] border-b py-2">
                                <span><strong><?=$lang[42]?> :</strong></span>
                                <span><?=$currancy.' '.$detail['total_plant_cost'];?></span>
                            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
        var bedElement = document.querySelector("#bed");
        var setImgElement = document.querySelector(".set_img");
        var gridElements = document.querySelectorAll(".grid1, .length, .width, .borderr");
        var hedgerowsElements = document.querySelectorAll(".hedgerows, .want, .hedge, .total_plants, .total_rows, .row_spacing");

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = '';
            });
        }

        function changeBed(value) {
            if (value == "grid") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/square.png')?>");
                showElements(gridElements);
                hideElements(hedgerowsElements);
            } else if (value == "hedgerow") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/single.png')?>");
                showElements(document.querySelectorAll(".hedgerows, .want, .hedge"));
                hideElements(document.querySelectorAll(".grid1, .length, .width, .borderr, .total_rows, .row_spacing"));
            }
        }

        bedElement.addEventListener("change", function() {
            changeBed(this.value);
        });

        var gridElement = document.querySelector("#grid");
        gridElement.addEventListener("change", function() {
            var value = this.value;
            if (value == "square") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/square.png')?>");
                hideElements(document.querySelectorAll(".want, .total_plants, .total_rows, .row_spacing"));
                showElements(document.querySelectorAll(".plant_spacing"));
            } else if (value == "rectangular") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/rectangle.png')?>");
                showElements(document.querySelectorAll(".plant_spacing, .want, .row_spacing"));
            } else if (value == "triangular") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/triangle.png')?>");
                hideElements(document.querySelectorAll(".want, .total_plants, .total_rows, .row_spacing"));
                showElements(document.querySelectorAll(".plant_spacing"));
            }
        });

        var hedgerowsElement = document.querySelector("#hedgerows");
        hedgerowsElement.addEventListener("change", function() {
            var value = this.value;
            var imgSrc = "";

            switch (value) {
                case "1":
                    imgSrc = "<?=asset('images/plant-spacing-img/single.png')?>";
                    break;
                case "2":
                    imgSrc = "<?=asset('images/plant-spacing-img/double.png')?>";
                    break;
                case "3":
                    imgSrc = "<?=asset('images/plant-spacing-img/triple.png')?>";
                    break;
                case "4":
                    imgSrc = "<?=asset('images/plant-spacing-img/four.png')?>";
                    break;
                case "5":
                    imgSrc = "<?=asset('images/plant-spacing-img/five.png')?>";
                    break;
            }
            setImgElement.setAttribute("src", imgSrc);
        });

        var wantElement = document.querySelector("#want");
        wantElement.addEventListener("change", function() {
            var value = this.value;
            var bed = bedElement.value;

            if (bed == "grid") {
                if (value == "amount") {
                    showElements(document.querySelectorAll(".plant_spacing, .row_spacing"));
                    hideElements(document.querySelectorAll(".total_plants, .total_rows"));
                } else {
                    showElements(document.querySelectorAll(".total_plants, .total_rows"));
                    hideElements(document.querySelectorAll(".plant_spacing, .row_spacing"));
                }
            } else {
                if (value == "amount") {
                    showElements(document.querySelectorAll(".plant_spacing"));
                    hideElements(document.querySelectorAll(".total_plants"));
                } else {
                    showElements(document.querySelectorAll(".total_plants"));
                    showElements(document.querySelectorAll(".total_plants, .total_rows"));
                    hideElements(document.querySelectorAll(".plant_spacing"));
                }
            }
        });

        // Initial check
        changeBed(bedElement.value);

        @if(isset($detail))
            var bed = bedElement.value;
            if (bed == "grid") {
                if (value == "amount") {
                    showElements(document.querySelectorAll(".plant_spacing, .row_spacing"));
                    hideElements(document.querySelectorAll(".total_plants, .total_rows"));
                } else {
                    showElements(document.querySelectorAll(".total_plants, .total_rows"));
                    hideElements(document.querySelectorAll(".plant_spacing, .row_spacing"));
                }
            } else {
                if (value == "amount") {
                    showElements(document.querySelectorAll(".plant_spacing"));
                    hideElements(document.querySelectorAll(".total_plants"));
                } else {
                    showElements(document.querySelectorAll(".total_plants"));
                    hideElements(document.querySelectorAll(".plant_spacing"));
                }
            }

            var value = gridElement.value;
            if (value == "square") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/square.png')?>");
                hideElements(document.querySelectorAll(".want, .total_plants, .total_rows, .row_spacing"));
                showElements(document.querySelectorAll(".plant_spacing"));
            } else if (value == "rectangular") {
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/rectangle.png')?>");
                showElements(document.querySelectorAll(".plant_spacing, .want, .row_spacing"));
                hideElements(document.querySelectorAll(" .total_plants, .total_rows"));
            } else if (value == "triangular") {
                showElements(document.querySelectorAll(".plant_spacing"));
                setImgElement.setAttribute("src", "<?=asset('images/plant-spacing-img/triangle.png')?>");
                hideElements(document.querySelectorAll(".want, .total_plants, .total_rows, .row_spacing"));
            }
            var value = wantElement.value;

            if (bed == "grid") {
                if (value == "amount") {
                    showElements(document.querySelectorAll(".plant_spacing, .row_spacing"));
                    hideElements(document.querySelectorAll(".total_plants, .total_rows"));
                } else {
                    showElements(document.querySelectorAll(".total_plants, .total_rows"));
                    hideElements(document.querySelectorAll(".plant_spacing, .row_spacing"));
                }
            } else {
                if (value == "amount") {
                    showElements(document.querySelectorAll(".plant_spacing"));
                    hideElements(document.querySelectorAll(".total_plants"));
                } else {
                    showElements(document.querySelectorAll(".total_plants"));
                    hideElements(document.querySelectorAll(".plant_spacing"));
                }
            }
        @endif
    });


    </script>
@endpush