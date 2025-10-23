<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class=" mx-auto mt-2    w-full lg:w-[80%] md:w-[80%]">
        <input type="hidden" name="selection" id="calculator_time" value="{{ isset(request()->selection) ? request()->selection : '1' }}">
        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
            <div class="lg:w-1/3 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  pacetab {{ isset(request()->selection) && request()->selection === '1'  ? 'tagsUnit' :'' }}" id="btw_first" onclick="change_tab(tab_val='f_tab')">
                        {{ $lang['2'] }}
                </div>
            </div>
            <div class="lg:w-1/3 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === '2'  ? 'tagsUnit' :'' }}" id="btw_second" onclick="change_tab(tab_val='s_tab')">
                        {{ $lang['3'] }}
                </div>
            </div>
            <div class="lg:w-1/3 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === '3'  ? 'tagsUnit' :'' }}" id="btw_third" onclick="change_tab(tab_val='t_tab')">
                        {{ $lang['4'] }}
                </div>
            </div>
        </div>
      </div>
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
          
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2">
                        <label for="material" class="label">{{ $lang['9'] }}</label>
                        <div class="w-100 py-2"> 
                            <select class="input" id="material" name="material" >
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["$lang[16] (¼” – 2″)", "$lang[17] (2″ – 6″)", "$lang[18] ($lang[19])", "$lang[20] ($lang[21])", "$lang[22] ($lang[19])", "$lang[22] ($lang[21])", "$lang[23]"];
                                    $val = ["105", "150", "160", "145", "168", "160", "168"];
                                    optionsList($val,$name,isset(request()->material)?request()->material:'105');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 length">
                        <label for="length" class="label">{{ $lang['5'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                            <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                            <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                                @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 width" >
                        <label for="width" class="label">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                            <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                            <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                                @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 area ">
                        <label for="area" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'ft²' }} ▾</label>
                            <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'ft²' }}" id="area_unit" class="hidden">
                            <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                                @foreach (["ft²", " yd²", "m²"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 depth">
                        <label for="depth" class="label">{{ $lang['15'] }} :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth'])?$_POST['depth']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth_unit_dropdown')">{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'ft²' }} ▾</label>
                            <input type="text" name="depth_unit" value="{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'ft²' }}" id="depth_unit" class="hidden">
                            <div id="depth_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="depth_unit">
                                @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('depth_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 volume">
                        <label for="volume" class="label">{{ $lang['8'] }} :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="volume" id="volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_unit_dropdown')">{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'ft²' }} ▾</label>
                            <input type="text" name="volume_unit" value="{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'ft²' }}" id="volume_unit" class="hidden">
                            <div id="volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="volume_unit">
                                @foreach (["ft³", "yd³", "m³"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('volume_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 price">
                        <label for="price" class="label">{{ $lang['10'] }} (<?= $lang[11] ?>) :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft²' }} ▾</label>
                            <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft²' }}" id="price_unit" class="hidden">
                            <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                                @foreach (["$currancy per ton", "$currancy per cu yad"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
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

    @isset($detail) 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $price_unit = trim( request()->price_unit);
                            $currancy = request()->currancy;
                            $price_unit = str_replace($currancy . ' ', '', $price_unit);
                            // dd($price_unit);
                        @endphp 
                        <div class="w-full my-2">
                            <div class="w-full md:w-[70%] lg:w-[70%]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-3"><strong><?= $lang['12'] ?> :</strong></td>
                                        <td class="border-b py-3"><?= round($detail['array'][0], 3) ?> - <?= round($detail['array'][1], 3) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong><?= $lang['13'] ?> :</td>
                                        <td class="border-b py-3"> <?= round($detail['cubicyd1'], 4) ?></td>
                                    </tr>
                                    @if (!empty(request()->price))
                                        <tr>
                                            <td class="border-b py-3"><strong><?= $lang['14'] ?> :</td>
                                            <td class="border-b py-3">
                                                <?php if ($price_unit == "per ton") { ?>
                                                    <?= round($detail['price_ton'][0]) ?><span><?=$currancy?></span> - <?= round($detail['price_ton'][1]) ?><span><?=$currancy?></span>
                                                <?php } else { ?>
                                                    <?= round($detail['price_cu']) ?><span><?=$currancy?></span>
                                                <?php } ?>    
                                            </td>
                                        </tr>
                                    @endif
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
            var tab = document.getElementById('calculator_time').value;
            if (tab === "1") {
                document.getElementById("btw_first").classList.add('tagsUnit');
                document.getElementById("btw_second").classList.remove('tagsUnit');
                document.getElementById("btw_third").classList.remove('tagsUnit');
                document.querySelectorAll('.width, .length, .depth').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.area, .volume').forEach(function(el) {
                    el.style.display = 'none';
                });
            }
            @if(isset($detail) || isset($error))
                if (tab === "1") {
                    document.getElementById("btw_first").classList.add('tagsUnit');
                    document.getElementById("btw_second").classList.remove('tagsUnit');
                    document.getElementById("btw_third").classList.remove('tagsUnit');
                    document.querySelectorAll('.width, .length, .depth').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.area, .volume').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelector('[name="selection"]').value = "1";
                } else if (tab === "2") {
                    document.getElementById("btw_second").classList.add('tagsUnit');
                    document.getElementById("btw_first").classList.remove('tagsUnit');
                    document.getElementById("btw_third").classList.remove('tagsUnit');
                    document.querySelectorAll('.width, .length, .volume').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.area, .depth').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelector('[name="selection"]').value = "2";
                } else {
                    document.getElementById("btw_third").classList.add('tagsUnit');
                    document.getElementById("btw_first").classList.remove('tagsUnit');
                    document.getElementById("btw_second").classList.remove('tagsUnit');
                    document.querySelectorAll('.width, .length, .area, .depth').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.volume').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelector('[name="selection"]').value = "3";
                }
            @endif
            function change_tab(element) {
                if (element === "f_tab") {
                    document.getElementById("btw_first").classList.add('tagsUnit');
                    document.getElementById("btw_second").classList.remove('tagsUnit');
                    document.getElementById("btw_third").classList.remove('tagsUnit');
                    document.querySelectorAll('.width, .length, .depth').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.area, .volume').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelector('[name="selection"]').value = "1";
                } else if (element === "s_tab") {
                    document.getElementById("btw_second").classList.add('tagsUnit');
                    document.getElementById("btw_first").classList.remove('tagsUnit');
                    document.getElementById("btw_third").classList.remove('tagsUnit');
                    document.querySelectorAll('.width, .length, .volume').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.area, .depth').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelector('[name="selection"]').value = "2";
                } else {
                    document.getElementById("btw_third").classList.add('tagsUnit');
                    document.getElementById("btw_first").classList.remove('tagsUnit');
                    document.getElementById("btw_second").classList.remove('tagsUnit');
                    document.querySelectorAll('.width, .length, .area, .depth').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.volume').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelector('[name="selection"]').value = "3";
                }
            }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>