<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
            <input type="hidden" name="selection" id="calculator_time" value="{{ isset(request()->selection) ? request()->selection : 'size' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  {{ isset(request()->selection) && request()->selection === 'distance'  ? '' :'tagsUnit' }} pacetab" id="btw_first" onclick="change_tab(tab_val='f_tab')">
                        <?=$lang['by_size']?>
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric {{ isset(request()->selection) && request()->selection === 'distance'  ? 'tagsUnit' :'' }}" id="btw_second" onclick="change_tab(tab_val='s_tab')">
                        <?=$lang['by_distance']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="resolution" class="label"><?=$lang['resolution']?></label>
                    <select name="resolution" id="resolution" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["480p","720p","1080p","Ultra HD","4k","8k"];
                        $val = ["480p","720p","1080p","ultra_hd","4k","8k"];
                            optionsList($val,$name,isset($_POST['resolution'])?$_POST['resolution']:'1080p');
                        @endphp
                    </select>
                </div>
                 <div class="space-y-2 size {{ isset(request()->selection) && request()->selection === 'distance'  ? 'hidden' :'d-block' }}">
                    <label for="size" class="font-s-14 text-blue">{{ $lang['screen_size'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="size" id="size" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['size'])?$_POST['size']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('size_unit_dropdown')">{{ isset($_POST['size_unit'])?$_POST['size_unit']:'in' }} ▾</label>
                        <input type="text" name="size_unit" value="{{ isset($_POST['size_unit'])?$_POST['size_unit']:'in' }}" id="size_unit" class="hidden">
                        <div id="size_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["cm","m",'in','ft'] as $item)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('size_unit', '{{$item}}')">{{$item}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 distance mt-2 {{ isset(request()->selection) && request()->selection === 'distance'  ? 'd-block' :'hidden' }}">
                    <label for="distance" class="font-s-14 text-blue">{{ $lang['v_distance'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="distance" id="distance" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance'])?$_POST['distance']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'in' }} ▾</label>
                        <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'in' }}" id="distance_unit" class="hidden">
                        <div id="distance_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%]mt-1 right-0 hidden">
                            @foreach (["cm","m",'in','ft'] as $item)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', '{{$item}}')">{{$item}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="angle" class="font-s-14 text-blue">{{ $lang['v_angle'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="distance" id="distance" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance'])?$_POST['distance']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                        <div id="angle_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["deg","red"] as $item)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', '{{$item}}')">{{$item}}</p>
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
                
              
    @if(isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue p-3 rounded-lg">
                        <div class="flex flex-wrap">
                            <div class="lg:w-2/3 w-full text-lg">
                                <?php
                                    $names = [$lang['s_size'], $lang['s_width'], $lang['s_height'], $lang['od'], $lang['md']];
                                    $ans_unit = 'in';
                                    foreach($detail['units_cm'] as $key => $unit){
                                        if(!empty($detail['ans'][$key])){
                                            if($key === 3 || $key === 4){
                                                $ans_unit = 'ft';
                                            }
                                ?>
                                <table class="w-full mb-4">
                                    <tr>
                                        <td class="w-7/10 border-b py-2 font-semibold"><?=$names[$key]?> :</td>
                                        <td class="border-b py-2"><?=$detail['ans'][$key]?> <?=$ans_unit?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">centimeter :</td>
                                        <td class="border-b py-2"><?=$unit?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">meter :</td>
                                        <td class="border-b py-2"><?=$detail['units_m'][$key]?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">inches :</td>
                                        <td class="border-b py-2"><?=$detail['units_in'][$key]?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">feet :</td>
                                        <td class="border-b py-2"><?=$detail['units_ft'][$key]?></td>
                                    </tr>
                                </table>
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
@push('calculatorJS')
    <script>
        function change_tab(element) {
            if (element === "f_tab") {
                document.getElementById("btw_first").classList.add('tagsUnit');
                document.getElementById("btw_second").classList.remove('tagsUnit');
                document.querySelectorAll('.size').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.distance').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelector('[name="selection"]').value = "size";
            } else {
                document.getElementById("btw_second").classList.add('tagsUnit');
                document.getElementById("btw_first").classList.remove('tagsUnit');
                document.querySelectorAll('.size').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('.distance').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelector('[name="selection"]').value = "distance";
            }
        }
    </script>
@endpush