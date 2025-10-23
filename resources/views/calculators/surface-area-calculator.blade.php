<style>
    #onetw{
        background: transparent;
        border: none;
        color: #1670a7;
        outline: none;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-6">
                <div class="col-12 px-2">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['43'] }}</label>
                    <div class="w-full py-2">
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
                                $name = [$lang[1],$lang[2],$lang[3],$lang[4],$lang[5],$lang[6],$lang[7],$lang[8],$lang[9],$lang[10],$lang[11],$lang[12],$lang[13]];
                                $val = ['1','2','3','4','5','6','7','8','9','10','11','12','13'];
                                optionsList($val,$name,isset($_POST['operations'])?$_POST['operations'] : '3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-6 px-2 shape">
                        <label for="shape" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input" name="shape" id="shape">
                                <?php
                                   $name=[$lang[15],$lang[16],$lang[17],$lang[18],$lang[19]];
                                    $val = ["1","2","3","4","5"];
                                    optionsList($val,$name,isset($_POST['shape'])?$_POST['shape'] : '1');
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-6 px-2 f1">
                        <label for="first" class="font-s-14 text-blue" id="txt1"><?=$lang[20]?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }} ▾</label>
                            <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }}" id="unit1" class="hidden">
                            <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mm')">millimetre  (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-6 px-2 f2">
                        <label for="second" class="font-s-14 text-blue" id="txt2">{{ $lang['21'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'m' }} ▾</label>
                            <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'m' }}" id="unit2" class="hidden">
                            <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mm')">millimetre  (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-6 px-2 f3">
                        <label for="third" class="font-s-14 text-blue" id="txt3">{{ $lang['24'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']:'m' }} ▾</label>
                            <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']:'m' }}" id="unit3" class="hidden">
                            <div id="unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit3">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'mm')">millimetre  (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-6 px-2 f4">
                        <label for="four" class="font-s-14 text-blue" id="txt4">{{ $lang['22'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four']) ? $_POST['four'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit4_dropdown')">{{ isset($_POST['unit4'])?$_POST['unit4']:'m' }} ▾</label>
                            <input type="text" name="unit4" value="{{ isset($_POST['unit4'])?$_POST['unit4']:'m' }}" id="unit4" class="hidden">
                            <div id="unit4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit4">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'mm')">millimetre  (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                  
                    <div class="col-lg-12 col-6 px-2 pi">
                        <label for="pi" class="font-s-14 text-blue"><?=$lang[23]?> π:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="pi" id="pi" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['pi'])?$_POST['pi']:'3.141593' }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                <img src="<?=asset('images/surface_area_images/surface3.png')?>" alt="surface image" width="200px" height="200px" class="change_img"> 
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
                            <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <table class="w-full">
                                    <?php
                                    if (isset($detail['height'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[25]?> :</strong></td>
                                          <td class="border-b py-2"><?=round($detail['height'], 3)?><span class="font-s-16"> (cm)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['ttsa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[26]?> :</strong></td>
                                          <td class="border-b py-2"><span class="font-s-16" id="circle_result"><?=round($detail['ttsa'], 3)?></span>
                                            <select name="circle_unit_result" id="onetw" class="d-inline ms-2" style="width:100px">
                                                @php
                                                    $name = ["in²","cm²","m²","ft²","yd²","km²","mm²"];
                                                    $val = ["in²","cm²","m²","ft²","yd²","km²","mm²"];
                                                    optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:'cm²');
                                                @endphp
                                            </select>
                                        </td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['csa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[27]?> :</strong></td>
                                          <td class="border-b py-2"><?=round($detail['csa'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['top'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[28]?> :</strong></td>
                                          <td class="border-b py-2"><?=round($detail['top'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['bsa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[44]?> :</strong></td>
                                          <td class="border-b py-2"><?=round($detail['bsa'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['lsa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[45]?> :</strong></td>
                                          <td class="border-b py-2"><?=round($detail['lsa'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    ?>
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
        document.addEventListener("DOMContentLoaded", () => {
            const conversionFactors = {
                'in²': 6.452, // in³ to cm³
                'cm²': 1,        // cm² to cm²
                'ft²': 929, // ft² to cm²
                'yd²': 8381, // yd² to cm²
                'm²': 10000,    // m² to cm²
                'km²': 1e-10,    // m² to cm²
                'mm²': 100    // m² to cm²
            };

            const circleResultDiv = document.getElementById('circle_result');
            const initialValue = parseFloat(circleResultDiv.innerText);
            circleResultDiv.setAttribute('data-initial-value', initialValue);

            document.getElementById('onetw').addEventListener('change', event => {
                const unit = event.target.value;
                const conversionFactor = conversionFactors[unit];
                const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));

                if (unit == 'mm²') {
                    const newValue = originalValue * conversionFactor;
                    circleResultDiv.innerText = Number(newValue.toFixed(6)).toString()  // Set the new value with unit
                } else {
                    const newValue = originalValue / conversionFactor;
                    circleResultDiv.innerText = Number(newValue.toFixed(6)).toString()  // Set the new value with unit
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var opt = document.getElementById('operations').value; 
            if(opt == '3'){
                document.querySelectorAll('.f1', '.f2', '.f3', '.pi').forEach(function(el) { el.style.display = 'block'; });
                document.querySelectorAll('.shape, .f4').forEach(function(el) { el.style.display = 'none'; });
            }
            document.getElementById('operations').addEventListener('change', function() {
                var a = this.value;
                var elementsToShow, elementsToHide, imgSrc, txt1, txt2, txt3, txt4;
                switch(a) {
                    case '1':
                        elementsToShow = ['.f1', '.f2', '.pi'];
                        elementsToHide = ['.f3', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface1.png')}}";
                        txt1 = '<?=$lang[29]?>';
                        txt2 = '<?=$lang[30]?>';
                        break;
                    case '2':
                        elementsToShow = ['.f1', '.f2', '.pi'];
                        elementsToHide = ['.f3', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface2.png')}}";
                        txt1 = '<?=$lang[29]?>';
                        txt2 = '<?=$lang[24]?>';
                        break;
                    case '3':
                        elementsToShow = ['.f1', '.f2', '.f3', '.pi'];
                        elementsToHide = ['.f4', '.shape'];
                        imgSrc = "{{asset('images/surface_area_images/surface3.png')}}";
                        txt1 = '<?=$lang[20]?>';
                        txt2 = '<?=$lang[21]?>';
                        txt3 = '<?=$lang[24]?>';
                        break;
                    case '4':
                        elementsToShow = ['.f1'];
                        elementsToHide = ['.f2', '.f3', '.pi', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface4.png')}}";
                        txt1 = '<?=$lang[30]?>';
                        break;
                    case '5':
                        elementsToShow = ['.f1', '.f2', '.pi'];
                        elementsToHide = ['.f3', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface5.png')}}";
                        txt1 = '<?=$lang[29]?>';
                        txt2 = '<?=$lang[24]?>';
                        break;
                    case '6':
                        elementsToShow = ['.f1', '.pi'];
                        elementsToHide = ['.f2', '.f3', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface6.png')}}";
                        txt1 = '<?=$lang[29]?>';
                        break;
                    case '7':
                        elementsToShow = ['.f1', '.f2', '.f3'];
                        elementsToHide = ['.pi', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface7.png')}}";
                        txt1 = '<?=$lang[24]?>';
                        txt2 = '<?=$lang[31]?>';
                        txt3 = '<?=$lang[32]?>';
                        break;
                    case '8':
                        elementsToShow = ['.f1', '.pi'];
                        elementsToHide = ['.f2', '.f3', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface8.png')}}";
                        txt1 = '<?=$lang[29]?>';
                        break;
                    case '9':
                        elementsToShow = ['.f1', '.f2', '.pi'];
                        elementsToHide = ['.f3', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface9.png')}}";
                        txt1 = '<?=$lang[33]?>';
                        txt2 = '<?=$lang[34]?>';
                        break;
                    case '10':
                        elementsToShow = ['.f1', '.f2', '.f3', '.f4'];
                        elementsToHide = ['.pi', '.shape'];
                        imgSrc = "{{asset('images/surface_area_images/surface10.png')}}";
                        txt1 = '<?=$lang[30]?>';
                        txt2 = '<?=$lang[35]?>';
                        txt3 = '<?=$lang[36]?>';
                        txt4 = '<?=$lang[24]?>';
                        break;
                    case '11':
                        elementsToShow = ['.f1', '.f2', '.shape'];
                        elementsToHide = ['.f3', '.pi', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface11.png')}}";
                        txt1 = '<?=$lang[37]?>';
                        txt2 = '<?=$lang[38]?>';
                        break;
                    case '12':
                        elementsToShow = ['.f1'];
                        elementsToHide = ['.f2', '.shape', '.f3', '.pi', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface12.png')}}";
                        txt1 = '<?=$lang[29]?>';
                        break;
                    case '13':
                        elementsToShow = ['.f1', '.f2', '.f4'];
                        elementsToHide = ['.f3', '.pi', '.shape'];
                        imgSrc = "{{asset('images/surface_area_images/surface13.png')}}";
                        txt1 = '<?=$lang[39]?>';
                        txt2 = '<?=$lang[40]?>';
                        txt4 = '<?=$lang[41]?>';
                        break;
                }

                // Show and hide elements
                elementsToShow.forEach(function(cls) {
                    document.querySelectorAll(cls).forEach(function(el) { el.style.display = 'block'; });
                });
                elementsToHide.forEach(function(cls) {
                    document.querySelectorAll(cls).forEach(function(el) { el.style.display = 'none'; });
                });

                // Change image source
                document.querySelector('.change_img').setAttribute('src', imgSrc);

                // Update text content
                document.getElementById('txt1').textContent = txt1 || '';
                document.getElementById('txt2').textContent = txt2 || '';
                if (txt3) document.getElementById('txt3').textContent = txt3;
                if (txt4) document.getElementById('txt4').textContent = txt4;
            });
        });

        document.getElementById("shape").addEventListener("change", function() {
            var a = this.value;
            var elementsToShow, elementsToHide, imgSrc, txt1, txt2, txt3;

            switch(a) {
                case '1':
                    elementsToShow = ['.f1', '.f2'];
                    elementsToHide = ['.f3', '.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface11.png')}}";
                    txt1 = '<?=$lang[37]?>';
                    txt2 = '<?=$lang[38]?>';
                    break;
                case '2':
                    elementsToShow = ['.f1', '.f2'];
                    elementsToHide = ['.f3', '.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/pyramids2.png')}}";
                    txt1 = '<?=$lang[37]?>';
                    txt2 = '<?=$lang[38]?>';
                    break;
                case '3':
                    elementsToShow = ['.f1', '.f2', '.f3'];
                    elementsToHide = ['.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/pyramids3.png')}}";
                    txt1 = '<?=$lang[37]?>';
                    txt2 = '<?=$lang[42]?>';
                    txt3 = '<?=$lang[24]?>';
                    break;
                case '4':
                    elementsToShow = ['.f1', '.f2'];
                    elementsToHide = ['.f3', '.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/pyramids4.png')}}";
                    txt1 = '<?=$lang[37]?>';
                    txt2 = '<?=$lang[38]?>';
                    break;
                case '5':
                    elementsToShow = ['.f1', '.f2'];
                    elementsToHide = ['.f3', '.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/pyramids5.png')}}";
                    txt1 = '<?=$lang[37]?>';
                    txt2 = '<?=$lang[38]?>';
                    break;
            }

            // Show and hide elements
            elementsToShow.forEach(function(cls) {
                document.querySelectorAll(cls).forEach(function(el) { el.style.display = 'block'; });
            });
            elementsToHide.forEach(function(cls) {
                document.querySelectorAll(cls).forEach(function(el) { el.style.display = 'none'; });
            });

            // Change image source
            document.querySelector('.change_img').setAttribute('src', imgSrc);

            // Update text content
            document.getElementById('txt1').textContent = txt1 || '';
            document.getElementById('txt2').textContent = txt2 || '';
            if (txt3) document.getElementById('txt3').textContent = txt3;
        });

        @if(isset($detail) || isset($error))
            var aee = document.getElementById('operations').value;
            var elementsToShow, elementsToHide, imgSrc, txt1, txt2, txt3, txt4;
            console.log(aee);
            switch(aee) {
                case '1':
                    elementsToShow = ['.f1', '.f2', '.pi'];
                    elementsToHide = ['.f3', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface1.png')}}";
                    txt1 = '<?=$lang[29]?>';
                    txt2 = '<?=$lang[30]?>';
                    break;
                case '2':
                    elementsToShow = ['.f1', '.f2', '.pi'];
                    elementsToHide = ['.f3', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface2.png')}}";
                    txt1 = '<?=$lang[29]?>';
                    txt2 = '<?=$lang[24]?>';
                    break;
                case '3':
                    elementsToShow = ['.f1', '.f2', '.f3', '.pi'];
                    elementsToHide = ['.f4', '.shape'];
                    imgSrc = "{{asset('images/surface_area_images/surface3.png')}}";
                    txt1 = '<?=$lang[20]?>';
                    txt2 = '<?=$lang[21]?>';
                    txt3 = '<?=$lang[24]?>';
                    break;
                case '4':
                    elementsToShow = ['.f1'];
                    elementsToHide = ['.f2', '.f3', '.pi', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface4.png')}}";
                    txt1 = '<?=$lang[30]?>';
                    break;
                case '5':
                    elementsToShow = ['.f1', '.f2', '.pi'];
                    elementsToHide = ['.f3', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface5.png')}}";
                    txt1 = '<?=$lang[29]?>';
                    txt2 = '<?=$lang[24]?>';
                    break;
                case '6':
                    elementsToShow = ['.f1', '.pi'];
                    elementsToHide = ['.f2', '.f3', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface6.png')}}";
                    txt1 = '<?=$lang[29]?>';
                    break;
                case '7':
                        elementsToShow = ['.f1', '.f2', '.f3'];
                        elementsToHide = ['.pi', '.shape', '.f4'];
                        imgSrc = "{{asset('images/surface_area_images/surface7.png')}}";
                        txt1 = '<?=$lang[24]?>';
                        txt2 = '<?=$lang[31]?>';
                        txt3 = '<?=$lang[32]?>';
                    break;
                case '8':
                    elementsToShow = ['.f1', '.pi'];
                    elementsToHide = ['.f2', '.f3', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface8.png')}}";
                    txt1 = '<?=$lang[29]?>';
                    break;
                case '9':
                    elementsToShow = ['.f1', '.f2', '.pi'];
                    elementsToHide = ['.f3', '.shape', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface9.png')}}";
                    txt1 = '<?=$lang[33]?>';
                    txt2 = '<?=$lang[34]?>';
                    break;
                case '10':
                    elementsToShow = ['.f1', '.f2', '.f3', '.f4'];
                    elementsToHide = ['.pi', '.shape'];
                    imgSrc = "{{asset('images/surface_area_images/surface10.png')}}";
                    txt1 = '<?=$lang[30]?>';
                    txt2 = '<?=$lang[35]?>';
                    txt3 = '<?=$lang[36]?>';
                    txt4 = '<?=$lang[24]?>';
                    break;
                case '11':
                    elementsToShow = ['.f1', '.f2', '.shape'];
                    elementsToHide = ['.f3', '.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface11.png')}}";
                    txt1 = '<?=$lang[37]?>';
                    txt2 = '<?=$lang[38]?>';
                    break;
                case '12':
                    elementsToShow = ['.f1'];
                    elementsToHide = ['.f2', '.shape', '.f3', '.pi', '.f4'];
                    imgSrc = "{{asset('images/surface_area_images/surface12.png')}}";
                    txt1 = '<?=$lang[29]?>';
                    break;
                case '13':
                    elementsToShow = ['.f1', '.f2', '.f4'];
                    elementsToHide = ['.f3', '.pi', '.shape'];
                    imgSrc = "{{asset('images/surface_area_images/surface13.png')}}";
                    txt1 = '<?=$lang[39]?>';
                    txt2 = '<?=$lang[40]?>';
                    txt4 = '<?=$lang[41]?>';
                    break;
            }
            elementsToShow.forEach(function(cls) {
                document.querySelectorAll(cls).forEach(function(el) { el.style.display = 'block'; });
            });
            elementsToHide.forEach(function(cls) {
                document.querySelectorAll(cls).forEach(function(el) { el.style.display = 'none'; });
            });
            // Change image source
            document.querySelector('.change_img').setAttribute('src', imgSrc);
            // Update text content
            document.getElementById('txt1').textContent = txt1 ;
            document.getElementById('txt2').textContent = txt2 ;
            if (txt3) document.getElementById('txt3').textContent = txt3;
            if (txt4) document.getElementById('txt4').textContent = txt4;       
        @endif
    </script>
@endpush