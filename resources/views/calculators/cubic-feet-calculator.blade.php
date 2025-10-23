@php
    if(isset($_POST['submit'])){
			$length=$_POST['length'];
			$width=$_POST['width'];
			$height=$_POST['height'];
			$length_unit=$_POST['length_unit'];
			$width_unit=$_POST['width_unit'];
			$height_unit=$_POST['height_unit'];
			$weight=$_POST['weight'];
			$weight_unit=$_POST['weight_unit'];
			$quantity=$_POST['quantity'];
			$price=$_POST['price'];
			$price_unit=$_POST['price_unit'];
			$room_unit=$_POST['room_unit'];
			$area=$_POST['area'];
			$area_unit=$_POST['area_unit'];
		}elseif(isset($_GET['res_link'])){
			$length=$_GET['length'];
			$width=$_GET['width'];
			$height=$_GET['height'];
			$length_unit=$_GET['length_unit'];
			$width_unit=$_GET['width_unit'];
			$height_unit=$_GET['height_unit'];
			$weight=$_GET['weight'];
			$weight_unit=$_GET['weight_unit'];
			$quantity=$_GET['quantity'];
			$price=$_GET['price'];
			$price_unit=$_GET['price_unit'];
			$room_unit=$_GET['room_unit'];
			$area=$_GET['area'];
			$area_unit=$_GET['area_unit'];
		}
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
            <div class="space-y-2 room_unit ">
                <label for="room_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full  position-relative"> 
                    <select name="room_unit" id="room_unit" class="input">    
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Length & Width & Height","Area & Height"];
                            $val = ["1","2"];
                            optionsList($val,$name,isset($_POST['room_unit'])?$_POST['room_unit']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="space-y-2 area {{ isset($_POST['room_unit']) && $_POST['room_unit'] === '2'?'d-block':'hidden' }}">
                <label for="area" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'in' }} ▾</label>
                    <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'in' }}" id="area_unit" class="hidden">
                    <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in')">sq in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft')">sq ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd')">sq yd</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm')">sq cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm')">sq m</p>
                    </div>
                </div>
             </div>
             <div class="space-y-2  length {{ isset($_POST['room_unit']) && $_POST['room_unit'] === '2' ?'hidden':'d-block' }}">
                <label for="length" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'in' }} ▾</label>
                    <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'in' }}" id="length_unit" class="hidden">
                    <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                        @foreach ( ["mm","cm","m","km","in","ft","yd","mi","nmi"]  as $name)
                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                </div>
             </div>
             <div class="space-y-2  width {{ isset($_POST['room_unit']) && $_POST['room_unit'] === '2' ?'hidden':'d-block' }}">
                <label for="width" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'in' }} ▾</label>
                    <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'in' }}" id="width_unit" class="hidden">
                    <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                        @foreach (["mm","cm","m","km","in","ft","yd","mi","nmi"] as $name)
                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                </div>
             </div>

             <div class="space-y-2  height">
                <label for="height" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height'])?$_POST['height']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }} ▾</label>
                    <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }}" id="height_unit" class="hidden">
                    <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                        @foreach (["mm","cm","m","km","in","ft","yd","mi","nmi"] as $name)
                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                </div>
             </div>
             <div class="space-y-2  weight {{ isset($_POST['room_unit']) && $_POST['room_unit'] === '2' ?'hidden':'d-block' }}">
                <label for="weight" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'m' }} ▾</label>
                    <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'m' }}" id="weight_unit" class="hidden">
                    <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                        @foreach ( ["lbs","kg"]  as $name)
                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('weight_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                </div>
             </div>
           
            <div class="space-y-2 quantity">
                <label for="quantity" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                <div class="w-full py-2"> 
                    <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset($_POST['quantity'])?$_POST['quantity']:'1' }}" />
                </div>
            </div>
            <div class="space-y-2  cost">
                <label for="price" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'m' }} ▾</label>
                    <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'m' }}" id="price_unit" class="hidden">
                    <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                        @foreach (["$currancy ft³","$currancy yd³","$currancy m³","$currancy cm³","$currancy in³"] as $name)
                        <p   class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
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
                        <div class="w-full my-1">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['volume'],2)}}  ft³</td>
                                    </tr>
                                    @if(!empty($price))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['12']}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy.' '.round($detail['estimated_price'])}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-1">{{$lang['12'].' '.$lang['17']}}</td>
                                    </tr>
                                    @if($room_unit === "1")
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}}  in³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_inches'],2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}} cm³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_centimeters'],2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}} m³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_meter'],5)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}} yards³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_yards'],5)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['14']}} Wt.kg :</td>
                                            <td class="border-b py-2">{{$detail['volumetric_weight']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['15']}} Wt.lbs :</td>
                                            <td class="border-b py-2">{{$detail['volumetric_weight2']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['16']}} lbs :</td>
                                            <td class="border-b py-2">{{$detail['weight']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['16']}} kg :</td>
                                            <td class="border-b py-2">{{$detail['weight_convert']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">20 FT :</td>
                                            <td class="border-b py-2">{{round($detail['twenty_ft'])}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">40 FT :</td>
                                            <td class="border-b py-2">{{round($detail['fourty_ft'])}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">40 HC :</td>
                                            <td class="border-b py-2">{{round($detail['fourty_high_cube'])}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}}  in³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_inches'],2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}} cm³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_centimeters'],2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}} m³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_meter'],5)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['13']}} yards³ :</td>
                                            <td class="border-b py-2">{{round($detail['cubic_yards'],5)}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            @if($room_unit === "1")
                                <div class="mt-3">
                                    <p class="font-s-20"><strong>{{ $lang['18'] }}</strong></p>
                                    <p class="mt-2 font-s-18"><b>{{ $lang['20'] }}:</b></p>
                                    <p class="mt-2">{{ $lang['11'] }} = {{ $lang['5'] }} (ft) × {{ $lang['6'] }} (ft) × {{ $lang['7'] }} (ft)</p>
                                    <p class="mt-2">{{ $lang['21'] }}</p>
                                    <p class="mt-2">{{ $length }} ({{ $length_unit }})
                                    = {{ round($detail['l'], 4) }} (ft)</p>
                                    <p class="mt-2">{{ $width; }} ({{ $width_unit }})
                                    = {{ round($detail['w'], 4) }} (ft)</p>
                                    <p class="mt-2">{{ $height; }} ({{ $height_unit }})
                                    = {{ round($detail['h'], 4) }} (ft)</p>
                                    <p class="mt-2">{{ $lang['22'] }}:</p>
                                    <p class="mt-2">{{ $lang['11'] }} = {{ round($detail['l'], 4) }} (ft) × {{ round($detail['w'], 4) }} (ft) × {{ round($detail['h'], 4) }} (ft)</p>
                                    <p class="mt-2">{{ $lang['11'] }} = {{ round($detail['volume'], 2) }} (ft³)</p>
                                    <p class="mt-2 font-s-18"><b>Cube Shape:</b></p>
                                    <div>
                                        <canvas class="my-3 m-auto" id="myCanvas" width="320" height="180"></canvas>
                                    </div>
                                </div>
                            @else
                                <div class="mt-3">
                                    <p class="font-s-20"><strong>{{ $lang['18'] }}</strong></p>
                                    <p class="mt-2 font-s-18"><b>{{ $lang['20'] }}:</b></p>
                                    <p class="mt-2">{{ $lang['11'] }} = {{ $lang['4'] }} (ft) × {{ $lang['7'] }} (ft)</p>
                                    <p class="mt-2">{{ $lang['21'] }}</p>
                                    <p class="mt-2">{{ $area; }} ({{ $area_unit; }})
                                    = {{ round($detail['convert13'], 4); }} (ft)</p>
                                    <p class="mt-2">{{ $height }} ({{ $height_unit }})
                                    = {{ round($detail['h1'], 4) }} (ft)</p>
                                    <p class="mt-2">{{ $lang['22'] }}:</p>
                                    <p class="mt-2">{{ $lang['11'] }} = {{ round($detail['convert13'], 4) }} (ft) × {{ round($detail['h1'], 4) }} (ft)</p>
                                    <p class="mt-2">{{ $lang['11'] }} = {{ round($detail['volume'], 4) }} (ft³)</p>
                
                                </div>
                            @endif
                        </div>
                    </div>

            </div>
        </div>
    </div>

        @push('calculatorJS')
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
            <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
            <script>
                @if($room_unit === "1")
                    $(document).ready(function(){
                        var c = document.getElementById("myCanvas");
                        var ctx = c.getContext("2d");
                        if (screen.width <= 370) {
                            c.width = screen.width;
                        }
                        var margin_x = 70,
                            margin_y = 50,
                            dm_x = margin_x * 2,
                            dm_y = margin_y * 2;
                        var w = c.width - dm_x,
                            h = c.height - dm_y,
                            offset_x = 35,
                            offset_y = 35;
                        var x = (c.width - w - offset_x) / 2;
                        var y = (c.height - h - offset_y) / 2 + offset_y;
                        var len = {{ $detail['l'] }};
                        var wid = {{ $detail['w'] }};
                        var hei = {{ $detail['h'] }};
                        function drawcube(len,wid,hei) {
                            var l2 = len;
                            var w2 = wid;
                            var h2 = hei;
                            var rate = 1;
                            var re = new RegExp(/[1-9][0-9]*\/[1-9][0-9]*/);
                            if (re.test(l2)) {
                                l2 = Fraction2Decimal(l2);
                            }
                            if (re.test(w2)) {
                                w2 = Fraction2Decimal(w2);
                            }
                            if (re.test(h2)) {
                                h2 = Fraction2Decimal(h2);
                            }
                            if ((l2 != '') && (w2 != '') && (h2 != '') && (!isNaN(l2)) && (!isNaN(w2)) && (!isNaN(h2))) {
                                rate = (c.height - dm_y) / h2;
                                w = w2 * rate;
                                h = h2 * rate;
                                if (w > (c.width - dm_x)) {
                                    rate = (c.width - dm_x) / w;
                                    w = c.width - dm_x;
                                    h = h * rate;
                                }
                                offset_x = l2 / h2 * h * 0.35;
                                offset_y = offset_x;
                                if ((offset_y + h) > (c.height - dm_y)) {
                                    rate = (c.height - dm_y) / (offset_y + h);
                                    w = w * rate;
                                    h = h * rate;
                                    offset_x = offset_x * rate;
                                    offset_y = offset_x;
                                }
                                x = (c.width - w - offset_x) / 2;
                                y = (c.height - h - offset_y) / 2 + offset_y;
                            }
                            ctx.clearRect(0, 0, c.width, c.height);
                            ctx.textAlign = "center";
                            ctx.beginPath();
                            ctx.lineWidth = "2";
                            ctx.strokeStyle = "#0072b7";
                            ctx.rect(x, y, w, h);
                            ctx.moveTo(x, y);
                            ctx.lineTo(x + offset_x, y - offset_y);
                            ctx.lineTo(x + w + offset_x, y - offset_y);
                            ctx.lineTo(x + w + offset_x, y + h - offset_y);
                            ctx.lineTo(x + w, y + h);
                            ctx.moveTo(x + w, y);
                            ctx.lineTo(x + w + offset_x, y - offset_y);
                            ctx.stroke();
                            ctx.font = "15px curly";
                            ctx.fillStyle = '#0072b7';
                            if (l2 > 0) {
                                txt = {{ $length }}  + ' ' + "{{ $length_unit }}" + '  ';
                                ctx.fillText(txt, x + offset_x / 2 - ctx.measureText(txt).width / 2 - 4, y - offset_y / 2);
                            }
                            if (h2 > 0) {
                                txt = {{ $height }} + ' ' + "{{ $height_unit }}" + '  ';
                                ctx.fillText(txt, x - ctx.measureText(txt).width / 2 - 4, (y + h / 2));
                            }
                            if (w2 > 0) {
                                ctx.fillText({{ $width }} + ' ' + "{{ $width_unit }}" + '  ', x + w / 2, y + h + 14);
                            }
                        }
                        drawcube(len,wid,hei);
                    });
                @endif
            </script>
        @endpush
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('room_unit').addEventListener('change',function(){
            var value = this.value;
            var length = document.querySelector('.length');
            var width = document.querySelector('.width');
            var height= document.querySelector('.height');
            var weight= document.querySelector('.weight');
            var area = document.querySelector('.area');
            if (value === "1") {
                length.style.display = "block";
                width.style.display = "block";
                weight.style.display = "block";
                height.style.display = "block";
                area.style.display = "none";
            } else {
                length.style.display = "none";
                width.style.display = "none";
                weight.style.display = "none";
                height.style.display = "block";
                area.style.display = "block";
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>