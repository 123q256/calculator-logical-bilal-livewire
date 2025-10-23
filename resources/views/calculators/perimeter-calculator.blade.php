<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-span-12">
                    <label for="shape" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <select name="shape" id="shape" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3],$lang[4],$lang[5],$lang[6],$lang[7],$lang[8],$lang[9],$lang[10],$lang[11],$lang[12],$lang[13],$lang[14]];
                                $val = ['1','2','3','4','5','6','7','8','9','10','11','12','13'];
                                optionsList($val,$name,isset($_POST['shape'])?$_POST['shape'] : '4');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 given">
                    <label for="given" class="font-s-14 text-blue">{{ $lang['15'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="given" id="given">
                            <?php
                                $name = [$lang[16],$lang[17],$lang[18]];
                                $val = ['1','2','3'];
                                optionsList($val,$name,isset($_POST['given'])?$_POST['given'] : '1');
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 givena">
                    <label for="givena" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="givena" id="givena">
                            <?php
                                 $name = [$lang[19],$lang[20],$lang[21]];
                                $val = ['1','2','3'];
                                optionsList($val,$name,isset($_POST['givena'])?$_POST['givena'] : '1');
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 nbr_main">
                    <label for="nbr" class="font-s-14 text-blue"><?=$lang[22]?> n:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="nbr" id="nbr" class="input" aria-label="input" value="{{ isset($_POST['nbr'])?$_POST['nbr']:'5' }}" />
                    </div>
                </div>

                <div class="col-span-12 r_main">
                    <label for="r" class="font-s-14 text-blue r">r:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="r" id="r" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['r']) ? $_POST['r'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="r_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('r_unit_dropdown')">{{ isset($_POST['r_unit'])?$_POST['r_unit']:'m' }} ▾</label>
                        <input type="text" name="r_unit" value="{{ isset($_POST['r_unit'])?$_POST['r_unit']:'m' }}" id="r_unit" class="hidden">
                        <div id="r_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="r_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_unit', 'mm')">millimetre  (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 b_main">
                    <label for="b" class="font-s-14 text-blue b">b:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="b" id="b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['b']) ? $_POST['b'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="b_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('b_unit_dropdown')">{{ isset($_POST['b_unit'])?$_POST['b_unit']:'m' }} ▾</label>
                        <input type="text" name="b_unit" value="{{ isset($_POST['b_unit'])?$_POST['b_unit']:'m' }}" id="b_unit" class="hidden">
                        <div id="b_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="b_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'mm')">millimetre  (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 c_main">
                    <label for="c" class="font-s-14 text-blue c">c:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="c" id="c" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c']) ? $_POST['c'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_unit_dropdown')">{{ isset($_POST['c_unit'])?$_POST['c_unit']:'m' }} ▾</label>
                        <input type="text" name="c_unit" value="{{ isset($_POST['c_unit'])?$_POST['c_unit']:'m' }}" id="c_unit" class="hidden">
                        <div id="c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'mm')">millimetre  (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 d_main">
                    <label for="d" class="font-s-14 text-blue">d:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="d" id="d" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['d']) ? $_POST['d'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:'m' }} ▾</label>
                        <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:'m' }}" id="d_unit" class="hidden">
                        <div id="d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mm')">millimetre  (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 angle_a">
                    <label for="angle" class="font-s-14 text-blue an_a"><?=$lang[24]?> β:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                        <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">deg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">rad</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 angle_b">
                    <label for="angleb" class="font-s-14 text-blue an_b"><?=$lang[24]?> γ:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angleb" id="angleb" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angleb']) ? $_POST['angleb'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angleb_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angleb_unit_dropdown')">{{ isset($_POST['angleb_unit'])?$_POST['angleb_unit']:'deg' }} ▾</label>
                        <input type="text" name="angleb_unit" value="{{ isset($_POST['angleb_unit'])?$_POST['angleb_unit']:'deg' }}" id="angleb_unit" class="hidden">
                        <div id="angleb_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angleb_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angleb_unit', 'deg')">deg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angleb_unit', 'rad')">rad</p>

                        </div>
                     </div>
                </div>
            </div>

            <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                <img src="<?=asset('images/circle.svg')?>" alt="Perimeter Calculator" width="150px" height="120" class="shape_img">
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
                        $shape = request()->shape;
                    @endphp
                    <div class="w-full my-2 flex justify-center">
                        <div class="text-center ">
                            <?php 
                                if ($shape==='1') { ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['2']?></strong></p>
                                        <img src="<?=asset('images/square.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif ($shape==='2') { ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['3']?></strong></p>
                                        <img src="<?=asset('images/rectangle.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='3'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['4']?></strong></p>
                                        <img src="<?=asset('images/triangle1.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='4'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['5']?></strong></p>
                                        <img src="<?=asset('images/circle.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='5'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['6']?></strong></p>
                                        <img src="<?=asset('images/semicircle-p.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='6'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['7']?></strong></p>
                                        <img src="<?=asset('images/sector.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='7'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['8']?></strong></p>
                                        <img src="<?=asset('images/ellipse.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='8'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['9']?></strong></p>
                                        <img src="<?=asset('images/trapezoid.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='9'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['10']?></strong></p>
                                        <img src="<?=asset('images/parallelogram1.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='10'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['11']?></strong></p>
                                        <img src="<?=asset('images/rhombus1.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='11'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['12']?></strong></p>
                                        <img src="<?=asset('images/kite.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='12'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['23']?> <?=$lang['13']?></strong></p>
                                        <img src="<?=asset('images/annulus4.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }elseif($shape==='13'){ ?>
                                        <p class="text-[20px] mb-2"><strong><?=$lang['14']?></strong></p>
                                        <img src="<?=asset('images/polygon.svg')?>" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                                <?php }
                                ?>
                            <div>    
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">{{$detail['peri']}}</strong></p>
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
        var shapeImg = document.querySelector('.shape_img');
        var elements = {
            r: document.querySelector('.r'),
            b: document.querySelector('.b'),
            c: document.querySelector('.c'),
            d: document.querySelector('.d'),
            angle_a: document.querySelector('.angle_a'),
            angle_b: document.querySelector('.angle_b'),
            angle_alpha: document.querySelector('.angle_alpha'),
            angle_gamma: document.querySelector('.angle_gamma'),
            angle_theta: document.querySelector('.angle_theta'),
            b_main: document.querySelector('.b_main'),
            c_main: document.querySelector('.c_main'),
            d_main: document.querySelector('.d_main'),
            given: document.querySelector('.given'),
            givena: document.querySelector('.givena'),
            nbr_main: document.querySelector('.nbr_main'),
            r_main: document.querySelector('.r_main'),
            e: document.querySelector('.e'),
            f: document.querySelector('.f'),
            an_a: document.querySelector('.an_a'),
            height: document.querySelector('.height'),
            area: document.querySelector('.area'),
            boxes: document.querySelector('.boxes')
        };

        function hideElements(selectors) {
            selectors.forEach(selector => {
                if (selector) selector.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                if (selector) selector.style.display = 'block';
            });
        }

        function changeImage(src) {
            shapeImg.src = src;
        }

        document.getElementById('shape').addEventListener('change', function() {
            var shape = this.value;
            switch (shape) {
                case '1':
                    elements.r.textContent = 'a';
                    hideElements([elements.angle_a, elements.angle_b, elements.b_main, elements.c_main, elements.d_main, elements.given, elements.nbr_main,elements.givena]);
                    showElements([elements.r_main]);
                    changeImage('<?=asset('images/square.svg')?>');
                    break;
                case '2':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    showElements([elements.b_main, elements.r_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.d_main, elements.given, elements.nbr_main,elements.givena]);
                    changeImage('<?=asset('images/rectangle.svg')?>');
                    break;
                case '3':
                    showElements([elements.given, elements.r_main, elements.b_main, elements.c_main]);
                    hideElements([elements.givena, elements.angle_a, elements.angle_b, elements.d_main, elements.nbr_main]);
                    var given = document.getElementById('given').value;
                    if (given === '1') {
                        elements.r.textContent = 'a';
                        elements.b.textContent = 'b';
                        elements.c.textContent = 'c';
                        changeImage('<?=asset('images/triangle1.svg')?>');
                    } else if (given === '2') {
                        elements.r.textContent = 'a';
                        elements.b.textContent = 'b';
                        showElements([elements.angle_b]);
                        hideElements([elements.c_main]);
                        changeImage('<?=asset('images/triangle2.svg')?>');
                    } else {
                        elements.r.textContent = 'a';
                        elements.an_a.textContent = 'Angle β';
                        showElements([elements.angle_a, elements.angle_b]);
                        hideElements([elements.c_main]);
                        changeImage('<?=asset('images/triangle3.svg')?>');
                    }
                    break;
                case '4':
                    elements.r.textContent = 'r';
                    showElements([elements.r_main]);
                    hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_a, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/circle.svg')?>');
                    break;
                case '5':
                    elements.r.textContent = 'r';
                    showElements([elements.r_main]);
                    hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_a, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/semicircle-p.svg')?>');
                    break;
                case '6':
                    elements.an_a.textContent = 'Angle α';
                    showElements([elements.r_main , elements.angle_a]);
                    hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/sector.svg')?>');
                    break;
                case '7':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    showElements([elements.r_main, elements.b_main]);
                    hideElements([elements.c_main, elements.angle_a, elements.d_main, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/ellipse.svg')?>');
                    break;
                case '8':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    elements.c.textContent = 'c';
                    elements.d.textContent = 'd';
                    showElements([elements.r_main, elements.b_main, elements.c_main, elements.d_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.given, elements.nbr_main]);
                    changeImage('<?=asset('images/trapezoid.svg')?>');
                    break;
                case '9':
                    showElements([elements.givena, elements.r_main, elements.b_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.d_main, elements.nbr_main, elements.given]);
                    var givena = document.getElementById('givena').value;
                    if (givena === '1') {
                        elements.r.textContent = 'a';
                        elements.b.textContent = 'b';
                        changeImage('<?=asset('images/parallelogram1.svg')?>');
                    } else if (givena === '2') {
                        elements.r.textContent = 'b';
                        elements.b.textContent = 'e';
                        elements.c.textContent = 'f';
                        showElements([elements.c_main]);
                        changeImage('<?=asset('images/parallelogram2.svg')?>');
                    } else {
                        elements.r.textContent = 'b';
                        elements.b.textContent = 'h';
                        elements.an_a.textContent = 'Angle α';
                        showElements([elements.angle_a]);
                        changeImage('<?=asset('images/parallelogram3.svg')?>');
                    }
                    break;
                case '10':
                    elements.r.textContent = 'a';
                    showElements([elements.r_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.b_main, elements.c_main, elements.d_main, elements.nbr_main, elements.given, elements.givena]);
                    changeImage('<?=asset('images/rhombus1.svg')?>');
                    break;
                case '11':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    showElements([elements.r_main, elements.b_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.d_main, elements.nbr_main, elements.given, elements.givena]);
                    changeImage('<?=asset('images/kite.svg')?>');
                    break;
                case '12':
                    elements.r.textContent = 'R';
                    elements.b.textContent = 'r';
                    showElements([elements.r_main, elements.b_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.nbr_main, elements.given, elements.givena, elements.d_main]);
                    changeImage('<?=asset('images/annulus4.svg')?>');
                    break;
                case '13':
                    elements.r.textContent = 'a';
                    showElements([elements.r_main, elements.nbr_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.b_main, elements.c_main, elements.given, elements.givena, elements.d_main]);
                    changeImage('<?=asset('images/polygon.svg')?>');
                    break;
            }
        });

        document.getElementById('given').addEventListener('change', function() {
            var given = this.value;
            var shapeImg = document.querySelector('.shape_img');
            var elements = {
                r: document.querySelector('.r'),
                b: document.querySelector('.b'),
                c: document.querySelector('.c'),
                an_a: document.querySelector('.an_a'),
                angle_a: document.querySelector('.angle_a'),
                angle_b: document.querySelector('.angle_b'),
                r_main: document.querySelector('.r_main'),
                b_main: document.querySelector('.b_main'),
                c_main: document.querySelector('.c_main')
            };

            function hideElements(selectors) {
                selectors.forEach(selector => {
                    if (selector) selector.style.display = 'none';
                });
            }

            function showElements(selectors) {
                selectors.forEach(selector => {
                    if (selector) selector.style.display = 'block';
                });
            }

            switch (given) {
                case '1':
                    shapeImg.src = '<?=asset('images/triangle1.svg')?>';
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    elements.c.textContent = 'c';
                    hideElements([elements.angle_a, elements.angle_b]);
                    showElements([elements.r_main, elements.b_main, elements.c_main]);
                    break;
                case '2':
                    shapeImg.src = '<?=asset('images/triangle2.svg')?>';
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    hideElements([elements.angle_a, elements.c_main]);
                    showElements([elements.angle_b, elements.r_main, elements.b_main]);
                    break;
                default:
                    shapeImg.src = '<?=asset('images/triangle3.svg')?>';
                    elements.r.textContent = 'a';
                    elements.an_a.textContent = 'Angle β';
                    hideElements([elements.c_main, elements.b_main]);
                    showElements([elements.angle_a, elements.angle_b, elements.r_main]);
                    break;
            }
        });


        document.getElementById('givena').addEventListener('change', function() {
            var given = this.value;
            var shapeImg = document.querySelector('.shape_img');
            var elements = {
                r: document.querySelector('.r'),
                b: document.querySelector('.b'),
                c: document.querySelector('.c'),
                an_a: document.querySelector('.an_a'),
                angle_a: document.querySelector('.angle_a'),
                angle_b: document.querySelector('.angle_b'),
                r_main: document.querySelector('.r_main'),
                b_main: document.querySelector('.b_main'),
                c_main: document.querySelector('.c_main'),
                d_main: document.querySelector('.d_main'),
                nbr_main: document.querySelector('.nbr_main'),
                given: document.querySelector('.given')
            };

            function hideElements(selectors) {
                selectors.forEach(selector => {
                    if (selector) selector.style.display = 'none';
                });
            }

            function showElements(selectors) {
                selectors.forEach(selector => {
                    if (selector) selector.style.display = 'block';
                });
            }

            switch (given) {
                case '1':
                    shapeImg.src = '<?=asset('images/parallelogram1.svg')?>';
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.nbr_main, elements.given]);
                    showElements([elements.r_main, elements.b_main]);
                    break;
                case '2':
                    shapeImg.src = '<?=asset('images/parallelogram2.svg')?>';
                    elements.r.textContent = 'b';
                    elements.b.textContent = 'e';
                    elements.c.textContent = 'f';
                    hideElements([elements.angle_a, elements.angle_b, elements.nbr_main, elements.given, elements.d_main]);
                    showElements([elements.r_main, elements.b_main, elements.c_main]);
                    break;
                default:
                    shapeImg.src = '<?=asset('images/parallelogram3.svg')?>';
                    elements.r.textContent = 'b';
                    elements.b.textContent = 'h';
                    elements.an_a.textContent = 'Angle α';
                    hideElements([elements.angle_b, elements.c_main, elements.nbr_main, elements.given, elements.d_main]);
                    showElements([elements.r_main, elements.b_main, elements.angle_a]);
                    break;
            }
        });


        var shape = document.getElementById('shape').value;
        if(shape == '4'){
            elements.r.textContent = 'r';
            showElements([elements.r_main]);
            hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_a, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
        }

        @if(isset($detail) || isset($error))
            switch (shape) {
                case '1':
                    elements.r.textContent = 'a';
                    hideElements([elements.angle_a, elements.angle_b, elements.b_main, elements.c_main, elements.d_main, elements.given, elements.nbr_main,elements.givena]);
                    showElements([elements.r_main]);
                    changeImage('<?=asset('images/square.svg')?>');
                    break;
                case '2':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    showElements([elements.b_main, elements.r_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.d_main, elements.given, elements.nbr_main,elements.givena]);
                    changeImage('<?=asset('images/rectangle.svg')?>');
                    break;
                case '3':
                    showElements([elements.given, elements.r_main, elements.b_main, elements.c_main]);
                    hideElements([elements.givena, elements.angle_a, elements.angle_b, elements.d_main, elements.nbr_main]);
                    var given = document.getElementById('given').value;
                    if (given === '1') {
                        elements.r.textContent = 'a';
                        elements.b.textContent = 'b';
                        elements.c.textContent = 'c';
                        changeImage('<?=asset('images/triangle1.svg')?>');
                    } else if (given === '2') {
                        elements.r.textContent = 'a';
                        elements.b.textContent = 'b';
                        showElements([elements.angle_b]);
                        hideElements([elements.c_main]);
                        changeImage('<?=asset('images/triangle2.svg')?>');
                    } else {
                        elements.r.textContent = 'a';
                        elements.an_a.textContent = 'Angle β';
                        showElements([elements.angle_a, elements.angle_b]);
                        hideElements([elements.c_main]);
                        changeImage('<?=asset('images/triangle3.svg')?>');
                    }
                    break;
                case '4':
                    elements.r.textContent = 'r';
                    showElements([elements.r_main]);
                    hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_a, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/circle.svg')?>');
                    break;
                case '5':
                    elements.r.textContent = 'r';
                    showElements([elements.r_main]);
                    hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_a, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/semicircle-p.svg')?>');
                    break;
                case '6':
                    elements.an_a.textContent = 'Angle α';
                    showElements([elements.r_main , elements.angle_a]);
                    hideElements([elements.c_main, elements.b_main, elements.d_main, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/sector.svg')?>');
                    break;
                case '7':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    showElements([elements.r_main, elements.b_main]);
                    hideElements([elements.c_main, elements.angle_a, elements.d_main, elements.angle_b, elements.given, elements.nbr_main, elements.givena]);
                    changeImage('<?=asset('images/ellipse.svg')?>');
                    break;
                case '8':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    elements.c.textContent = 'c';
                    elements.d.textContent = 'd';
                    showElements([elements.r_main, elements.b_main, elements.c_main, elements.d_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.given, elements.nbr_main]);
                    changeImage('<?=asset('images/trapezoid.svg')?>');
                    break;
                case '9':
                    showElements([elements.givena, elements.r_main, elements.b_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.d_main, elements.nbr_main, elements.given]);
                    var givena = document.getElementById('givena').value;
                    if (givena === '1') {
                        elements.r.textContent = 'a';
                        elements.b.textContent = 'b';
                        changeImage('<?=asset('images/parallelogram1.svg')?>');
                    } else if (givena === '2') {
                        elements.r.textContent = 'b';
                        elements.b.textContent = 'e';
                        elements.c.textContent = 'f';
                        showElements([elements.c_main]);
                        changeImage('<?=asset('images/parallelogram2.svg')?>');
                    } else {
                        elements.r.textContent = 'b';
                        elements.b.textContent = 'h';
                        elements.an_a.textContent = 'Angle α';
                        showElements([elements.angle_a]);
                        changeImage('<?=asset('images/parallelogram3.svg')?>');
                    }
                    break;
                case '10':
                    elements.r.textContent = 'a';
                    showElements([elements.r_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.b_main, elements.c_main, elements.d_main, elements.nbr_main, elements.given, elements.givena]);
                    changeImage('<?=asset('images/rhombus1.svg')?>');
                    break;
                case '11':
                    elements.r.textContent = 'a';
                    elements.b.textContent = 'b';
                    showElements([elements.r_main, elements.b_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.d_main, elements.nbr_main, elements.given, elements.givena]);
                    changeImage('<?=asset('images/kite.svg')?>');
                    break;
                case '12':
                    elements.r.textContent = 'R';
                    elements.b.textContent = 'r';
                    showElements([elements.r_main, elements.b_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.c_main, elements.nbr_main, elements.given, elements.givena, elements.d_main]);
                    changeImage('<?=asset('images/annulus4.svg')?>');
                    break;
                case '13':
                    elements.r.textContent = 'a';
                    showElements([elements.r_main, elements.nbr_main]);
                    hideElements([elements.angle_a, elements.angle_b, elements.b_main, elements.c_main, elements.given, elements.givena, elements.d_main]);
                    changeImage('<?=asset('images/polygon.svg')?>');
                    break;
            }
        @endif


</script>
@endpush