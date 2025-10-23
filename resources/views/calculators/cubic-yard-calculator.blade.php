<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-5">
                    <div class="space-y-2">
                        <div class="grid grid-cols-1   gap-6">
                            <div class="space-y-2 ">
                                <label for="operations" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                                <div class="w-100  relative"> 
                                    <select name="operations" id="operations" class="input">    
                                        @php
                                            function optionsList($arr1,$arr2,$unit){
                                            foreach($arr1 as $index => $name){
                                        @endphp
                                            <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                                {{ $arr2[$index] }}
                                            </option>
                                        @php
                                            }}
                                            $name = [$lang[2],$lang[3],$lang[4],$lang[5],$lang[6],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13'],$lang['14'],$lang['15'],$lang['16']];
                                            $val = [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17];
                                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:3);
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2" id="extra">
                                <label for="extra_area" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="extra_area" id="extra_area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['extra_area'])?$_POST['extra_area']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="extra_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('extra_units_dropdown')">{{ isset($_POST['extra_units'])?$_POST['extra_units']:'ft²' }} ▾</label>
                                    <input type="text" name="extra_units" value="{{ isset($_POST['extra_units'])?$_POST['extra_units']:'ft²' }}" id="extra_units" class="hidden">
                                    <div id="extra_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="extra_units">
                                        @foreach (["in²","ft²","cm²","m²","yd²"]  as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('extra_units', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 first" id="1">
                                <label for="first" class="font-s-14 text-blue" id="lb_1">{{ $lang['18'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'in' }} ▾</label>
                                    <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'in' }}" id="units1" class="hidden">
                                    <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                                        @foreach (["in","ft","cm","m","yd"]  as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units1', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 second" id="2">
                                <label for="second" class="font-s-14 text-blue" id="lb_2">{{ $lang['19'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'in' }} ▾</label>
                                    <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'in' }}" id="units2" class="hidden">
                                    <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units2', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 third" id="3">
                                <label for="third" class="font-s-14 text-blue" id="lb_3">{{ $lang['20'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'in' }} ▾</label>
                                    <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'in' }}" id="units3" class="hidden">
                                    <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units3', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 four" id="4">
                                <label for="four" class="font-s-14 text-blue" id="lb_4">{{ $lang['21'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'17' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'in' }} ▾</label>
                                    <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'in' }}" id="units4" class="hidden">
                                    <div id="units4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units4">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units4', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 five" id="5">
                                <label for="five" class="font-s-14 text-blue" id="lb_5">{{ $lang['22'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five'])?$_POST['five']:'17' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units5_dropdown')">{{ isset($_POST['units5'])?$_POST['units5']:'in' }} ▾</label>
                                    <input type="text" name="units5" value="{{ isset($_POST['units5'])?$_POST['units5']:'in' }}" id="units5" class="hidden">
                                    <div id="units5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units5">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units5', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2  fiveb" id="5b">
                                <label for="fiveb" class="font-s-14 text-blue">{{ $lang['23'] }}:</label>
                                <div class="w-full py-2 position-relative"> 
                                    <input type="number" step="any" name="fiveb" id="fiveb" class="input" aria-label="input"  value="{{ isset($_POST['fiveb'])?$_POST['fiveb']:'17' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 price">
                                <label for="price" class="font-s-14 text-blue">{{ $lang['25'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'17' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft³' }} ▾</label>
                                    <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft³' }}" id="price_unit" class="hidden">
                                    <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                                        <input type="hidden" name="currancy" value="{{$currancy}}">
                                        @foreach (["$currancy ft³","$currancy yd³","$currancy m³"] as $name)
                                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="grid grid-cols-1   gap-6">
                            <div class="space-y-2 quantity" id="6">
                                <label for="quantity" class="font-s-14 text-blue">{{ $lang['24'] }}:</label>
                                <div class="w-full "> 
                                    <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset($_POST['quantity'])?$_POST['quantity']:'1' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 ">
                                <img src="<?=asset('images/cubic-yards-rectangle.png')?>" id="im" alt="Polygon Calculator" width="100%" height="300px">
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
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong><?=$lang['26']?>  ft³ :</strong></td>
                                    <td class="border-b py-2"><?=$detail['cubic_feet']." "."ft³"?></td>
                                </tr>
                                @if(!empty($detail['estimated_price']))
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang['27']?> :</strong></td>
                                        <td class="border-b py-2"><?=$currancy.' '.$detail['estimated_price']?></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border-b py-2"><?=$lang['28']?>   in³ :</td>
                                    <td class="border-b py-2"><?=$detail['cubic_in']." "."in³"?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['28']?>   cm³ :</td>
                                    <td class="border-b py-2"><?=$detail['cubic_cm']." "."cm³"?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['28']?>  m³ :</td>
                                    <td class="border-b py-2"><?=$detail['cubic_meter']." "."m³"?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['28']?>  yards³ :</td>
                                    <td class="border-b py-2"><?=$detail['cubic_yard']." "."yd³"?></td>
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
        var elements = {
            1: document.getElementById("1"),
            2: document.getElementById("2"),
            3: document.getElementById("3"),
            4: document.getElementById("4"),
            5: document.getElementById("5"),
            51: document.getElementById("5b"),
            6: document.getElementById("6"),
            extra: document.getElementById("extra"),
            first: document.getElementById("first"),
            second: document.getElementById("second"),
            third: document.getElementById("third"),
            lb_1: document.getElementById("lb_1"),
            lb_2: document.getElementById("lb_2"),
            lb_3: document.getElementById("lb_3"),
            lb_4: document.getElementById("lb_4"),
            im: document.getElementById("im")
        };
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector("#operations").addEventListener('change', function() {
                var cal = this.value;
                if (cal == '3') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "Depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "length";
                    elements.lb_2.textContent = "length:";
                    elements.third.placeholder = "width";
                    elements.lb_3.textContent = "Width:";
                    elements.im.src = '<?=asset("images/cubic-yards-rectangle.png")?>';
                } else if (cal == '4') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "side length";
                    elements.lb_2.textContent = "Side Length:";
                    elements.im.src = '<?=asset("images/cubic-yards-square.png")?>';
                } else if (cal == '5') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'block';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "Depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "Inner length";
                    elements.lb_2.textContent = "Inner Length:";
                    elements.third.placeholder = "Inner width";
                    elements.lb_3.textContent = "Inner Width:";
                    elements.lb_4.textContent = "Border Width:";
                    elements.im.src = '<?=asset("images/cubic-yards-rectangle-border.png")?>';
                } else if (cal == '6') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "diameter";
                    elements.lb_2.textContent = "Diameter:";
                    elements.im.src = '<?=asset("images/cubic-yards-circle.png")?>';
                } else if (cal == '7') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "Inner Diameter";
                    elements.lb_2.textContent = "Inner Diameter:";
                    elements.third.placeholder = "border width";
                    elements.lb_3.textContent = "Border Width:";
                    elements.im.src = '<?=asset("images/cubic-yards-circle-border.png")?>';
                } else if (cal == '8') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "Outer Diameter";
                    elements.lb_2.textContent = "Outer Diameter:";
                    elements.third.placeholder = "Inner Diameter";
                    elements.lb_3.textContent = "Inner Diameter:";
                    elements.im.src = '<?=asset("images/cubic-yards-annulus.png")?>';
                } else if (cal == '9') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'block';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "side a length";
                    elements.lb_2.textContent = "Side a Length:";
                    elements.third.placeholder = "side b length";
                    elements.lb_3.textContent = "Side b Length:";
                    elements.lb_4.textContent = "Side c Length:";
                    elements.im.src = '<?=asset("images/cubic-yards-triangle.png")?>';
                } else if (cal == '10') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'block';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "depth";
                    elements.lb_1.textContent = "Depth:";
                    elements.second.placeholder = "side a length";
                    elements.lb_2.textContent = "Side a Length:";
                    elements.third.placeholder = "side b length";
                    elements.lb_3.textContent = "Side b Length:";
                    elements.lb_4.textContent = "Height h:";
                    elements.im.src = '<?=asset("images/cubic-yards-trapezoid.png")?>';
                } else if (cal == '11') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'none';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "length and depth / height";
                    elements.lb_1.textContent = "Length and Depth / Height:";
                    elements.im.src = '<?=asset("images/cube_yard.png")?>';
                } else if (cal == '12') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "radius";
                    elements.lb_1.textContent = "Radius:";
                    elements.second.placeholder = "depth / height";
                    elements.lb_2.textContent = "Depth / Height:";
                    elements.im.src = '<?=asset("images/cylinder_yard.png")?>';
                } else if (cal == '13') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[3].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "outer radius";
                    elements.lb_1.textContent = "Outer Radius:";
                    elements.second.placeholder = "Inner Radius";
                    elements.lb_2.textContent = "Inner Radius:";
                    elements.third.placeholder = "depth";
                    elements.lb_3.textContent = "Depth:";
                    elements.im.src = '<?=asset("images/hollow-cylinder_yard.png")?>';
                } else if (cal == '14') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'none';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "radius";
                    elements.lb_1.textContent = "Radius:";
                    elements.im.src = '<?=asset("images/hemisphere_yard.png")?>';
                } else if (cal == '15') {
                    elements[1].style.display = 'block';
                    elements[2].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'none';
                    elements.first.placeholder = "radius";
                    elements.lb_1.textContent = "Radius:";
                    elements.second.placeholder = "depth / height";
                    elements.lb_2.textContent = "Depth / Height:";
                    elements.im.src = '<?=asset("images/cone_yard.png")?>';
                } else if (cal == '16') {
                    elements[1].style.display = 'none';
                    elements[2].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'block';
                    elements.second.placeholder = "depth / height";
                    elements.lb_2.textContent = "Depth / Height:";
                    elements.im.src = '<?=asset("images/pyramid_yard.png")?>';
                } else if (cal == '17') {
                    elements[1].style.display = 'none';
                    elements[2].style.display = 'block';
                    elements[6].style.display = 'block';
                    elements[3].style.display = 'none';
                    elements[4].style.display = 'none';
                    elements[5].style.display = 'none';
                    elements[51].style.display = 'none';
                    elements.extra.style.display = 'block';
                    elements.second.placeholder = "depth / height";
                    elements.lb_2.textContent = "Depth / Height:";
                    elements.im.src = '<?=asset("images/other_yard.png")?>';
                } 
            });
            
            var initalvalue = document.querySelector("#operations").value;
            if (initalvalue == '3') {
                elements[1].style.display = 'block';
                elements[2].style.display = 'block';
                elements[3].style.display = 'block';
                elements[6].style.display = 'block';
                elements[4].style.display = 'none';
                elements[5].style.display = 'none';
                elements[51].style.display = 'none';
                elements.extra.style.display = 'none';
                elements.first.placeholder = "Depth";
                elements.lb_1.textContent = "Depth:";
                elements.second.placeholder = "length";
                elements.lb_2.textContent = "length:";
                elements.third.placeholder = "width";
                elements.lb_3.textContent = "Width:";
                elements.im.src = '<?=asset("images/cubic-yards-rectangle.png")?>';
            }
        });
            @if(isset($detail) || isset($error))
                var initalvalue = "{{ request()->operations }}";
                    if (initalvalue == '3') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "Depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "length";
                        elements.lb_2.textContent = "length:";
                        elements.third.placeholder = "width";
                        elements.lb_3.textContent = "Width:";
                        elements.im.src = '<?=asset("images/cubic-yards-rectangle.png")?>';
                    } else if (initalvalue == '4') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "side length";
                        elements.lb_2.textContent = "Side Length:";
                        elements.im.src = '<?=asset("images/cubic-yards-square.png")?>';
                    } else if (initalvalue == '5') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'block';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "Depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "Inner length";
                        elements.lb_2.textContent = "Inner Length:";
                        elements.third.placeholder = "Inner width";
                        elements.lb_3.textContent = "Inner Width:";
                        elements.lb_4.textContent = "Border Width:";
                        elements.im.src = '<?=asset("images/cubic-yards-rectangle-border.png")?>';
                    } else if (initalvalue == '6') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "diameter";
                        elements.lb_2.textContent = "Diameter:";
                        elements.im.src = '<?=asset("images/cubic-yards-circle.png")?>';
                    } else if (initalvalue == '7') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "Inner Diameter";
                        elements.lb_2.textContent = "Inner Diameter:";
                        elements.third.placeholder = "border width";
                        elements.lb_3.textContent = "Border Width:";
                        elements.im.src = '<?=asset("images/cubic-yards-circle-border.png")?>';
                    } else if (initalvalue == '8') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "Outer Diameter";
                        elements.lb_2.textContent = "Outer Diameter:";
                        elements.third.placeholder = "Inner Diameter";
                        elements.lb_3.textContent = "Inner Diameter:";
                        elements.im.src = '<?=asset("images/cubic-yards-annulus.png")?>';
                    } else if (initalvalue == '9') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'block';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "side a length";
                        elements.lb_2.textContent = "Side a Length:";
                        elements.third.placeholder = "side b length";
                        elements.lb_3.textContent = "Side b Length:";
                        elements.lb_4.textContent = "Side c Length:";
                        elements.im.src = '<?=asset("images/cubic-yards-triangle.png")?>';
                    } else if (initalvalue == '10') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'block';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "depth";
                        elements.lb_1.textContent = "Depth:";
                        elements.second.placeholder = "side a length";
                        elements.lb_2.textContent = "Side a Length:";
                        elements.third.placeholder = "side b length";
                        elements.lb_3.textContent = "Side b Length:";
                        elements.lb_4.textContent = "Height h:";
                        elements.im.src = '<?=asset("images/cubic-yards-trapezoid.png")?>';
                    } else if (initalvalue == '11') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'none';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "length and depth / height";
                        elements.lb_1.textContent = "Length and Depth / Height:";
                        elements.im.src = '<?=asset("images/cube_yard.png")?>';
                    } else if (initalvalue == '12') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "radius";
                        elements.lb_1.textContent = "Radius:";
                        elements.second.placeholder = "depth / height";
                        elements.lb_2.textContent = "Depth / Height:";
                        elements.im.src = '<?=asset("images/cylinder_yard.png")?>';
                    } else if (initalvalue == '13') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[3].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "outer radius";
                        elements.lb_1.textContent = "Outer Radius:";
                        elements.second.placeholder = "Inner Radius";
                        elements.lb_2.textContent = "Inner Radius:";
                        elements.third.placeholder = "depth";
                        elements.lb_3.textContent = "Depth:";
                        elements.im.src = '<?=asset("images/hollow-cylinder_yard.png")?>';
                    } else if (initalvalue == '14') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'none';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "radius";
                        elements.lb_1.textContent = "Radius:";
                        elements.im.src = '<?=asset("images/hemisphere_yard.png")?>';
                    } else if (initalvalue == '15') {
                        elements[1].style.display = 'block';
                        elements[2].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'none';
                        elements.first.placeholder = "radius";
                        elements.lb_1.textContent = "Radius:";
                        elements.second.placeholder = "depth / height";
                        elements.lb_2.textContent = "Depth / Height:";
                        elements.im.src = '<?=asset("images/cone_yard.png")?>';
                    } else if (initalvalue == '16') {
                        elements[1].style.display = 'none';
                        elements[2].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'block';
                        elements.second.placeholder = "depth / height";
                        elements.lb_2.textContent = "Depth / Height:";
                        elements.im.src = '<?=asset("images/pyramid_yard.png")?>';
                    } else if (initalvalue == '17') {
                        elements[1].style.display = 'none';
                        elements[2].style.display = 'block';
                        elements[6].style.display = 'block';
                        elements[3].style.display = 'none';
                        elements[4].style.display = 'none';
                        elements[5].style.display = 'none';
                        elements[51].style.display = 'none';
                        elements.extra.style.display = 'block';
                        elements.second.placeholder = "depth / height";
                        elements.lb_2.textContent = "Depth / Height:";
                        elements.im.src = '<?=asset("images/other_yard.png")?>';
                    } 
            @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>