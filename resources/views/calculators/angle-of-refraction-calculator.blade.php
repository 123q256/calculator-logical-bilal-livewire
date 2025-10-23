<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-6">
                <div class="row">
                    <div class="w-full px-2 mb-4">
                        <label for="calculation" class="font-s-14 text-blue">{{ $lang[1] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="calculation" id="calculation" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = ["Find n1 | Given n2, θ₁ and θ₂","Find n2 | Given n1, θ₁ and θ₂","Find θ₁ | Given n1, n2 and θ₂"," Find θ₂ | Given n1, n2 and θ₁"];
                                    $val = ["from1","from2","from3","from4"];
                                    optionsList($val,$name,isset($_POST['calculation'])?$_POST['calculation']:'from2');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="w-full mb-4" id="medium_index_1">
                        <div class="row">
                            <div class="w-full px-2">
                                <label for="medium1" class="font-s-14 text-blue">{{ $lang[12] }} 1</label>
                                <div class="w-100 py-2 position-relative">
                                    <select name="medium1" id="medium1" class="input">
                                        @php
                                            $name = [$lang[2],$lang[3],$lang[4]." 20°C 🌊",$lang[5],$lang[6]." 🧊",$lang[7],$lang[8],$lang[9],$lang[10]];
                                             $val = ["vacuum","air","water","ethanol","ice","acrylic","window","diamond","custom"];
                                            optionsList($val,$name,isset($_POST['medium1'])?$_POST['medium1']:'vacuum');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-2">
                                <label for="n1" class="font-s-14 text-blue">{{ $lang[11] }} 1 (n₁)</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="n1" id="n1" value="{{ isset($_POST['n1']) ? $_POST['n1'] : '1' }}" class="input" aria-label="input" placeholder="00" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mb-4" id="medium_index_2">
                        <div class="row">
                            <div class="w-full px-2">
                                <label for="medium2" class="font-s-14 text-blue">{{ $lang[12] }} 2</label>
                                <div class="w-100 py-2 position-relative">
                                    <select name="medium2" id="medium2" class="input">
                                        @php
                                            $name = [$lang[2],$lang[3],$lang[4]." 20°C 🌊",$lang[5],$lang[6]." 🧊",$lang[7],$lang[8],$lang[9],$lang[10]];
                                             $val = ["vacuum","air","water","ethanol","ice","acrylic","window","diamond","custom"];
                                            optionsList($val,$name,isset($_POST['medium2'])?$_POST['medium2']:'air');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-2">
                                <label for="n2" class="font-s-14 text-blue">{{ $lang[11] }} 2 (n₂)</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="n2" id="n2" value="{{ isset($_POST['n2']) ? $_POST['n2'] : '1.000293' }}" class="input" aria-label="input" placeholder="00" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 mb-4" id="angle1">
                        <label for="angle_first" class="font-s-14 text-blue">{{ $lang[13] }} (θ₁)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="angle_first" id="angle_first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_first'])?$_POST['angle_first']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="angle_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_f_unit_dropdown')">{{ isset($_POST['angle_f_unit'])?$_POST['angle_f_unit']:'deg' }} ▾</label>
                           <input type="text" name="angle_f_unit" value="{{ isset($_POST['angle_f_unit'])?$_POST['angle_f_unit']:'deg' }}" id="angle_f_unit" class="hidden">
                           <div id="angle_f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_f_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'deg')">deg</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'rad')">rad</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'gon')">gon</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'tr')">tr</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'arcmin')">arcmin</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'arcsec')">arcsec</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'mrad')">mrad</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'μrad')">μrad</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', '* π rad')">* π rad</p>
                           </div>
                        </div>
                      </div>
                      <div class="w-full px-2 mb-3" id="angle2">
                        <label for="angle_second" class="font-s-14 text-blue">{{ $lang[13] }} (θ₁)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="angle_second" id="angle_second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_second'])?$_POST['angle_second']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="angle_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_s_unit_dropdown')">{{ isset($_POST['angle_s_unit'])?$_POST['angle_s_unit']:'deg' }} ▾</label>
                           <input type="text" name="angle_s_unit" value="{{ isset($_POST['angle_s_unit'])?$_POST['angle_s_unit']:'deg' }}" id="angle_s_unit" class="hidden">
                           <div id="angle_s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_s_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'deg')">deg</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'rad')">rad</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'gon')">gon</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'tr')">tr</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'arcmin')">arcmin</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'arcsec')">arcsec</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'mrad')">mrad</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'μrad')">μrad</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', '* π rad')">* π rad</p>
                           </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-span-6 text-center px-2">
                <img src="{{url('images/snells_img.svg')}}" alt="Triangle Image" width="250px" height="165px">
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
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  mt-3">
                    <div class="w-full">
                        @php
                            $request = request();
                            $calculation = $request->calculation;
                            $medium1 = $request->medium1;
                            $n1 = $request->n1;
                            $medium2 = $request->medium2;
                            $n2 = $request->n2;
                            $angle_first = $request->angle_first;
                            $angle_f_unit = $request->angle_f_unit;
                            $angle_second = $request->angle_second;
                            $angle_s_unit = $request->angle_s_unit;
                        @endphp
                        <?php if ($detail['calculation'] === "from1") { ?>
                            <div class="text-center">
                                <p class="text-[19px]"><strong><?= $lang[11] ?> 1 (n₁)</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[21px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['jawab'], 6) }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[14] ?></strong></p>
                            <p class="w-full mt-2">n₂ <?= $lang[15] ?> 2 = <?= $n2 ?></p>
                            <p class="w-full mt-2"><?= $lang[13] ?> (θ₁) = <?= $detail['angle_first'] ?></p>
                            <p class="w-full mt-2"><?= $lang[19] ?> (θ₂) = <?= $detail['angle_second'] ?></p>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[16] ?></strong></p>
                            <p class="w-full mt-2"><?= $lang[17] ?> = (n₂ * sin(θ₂)) / sin(θ₁)</p>
                            <p class="w-full mt-2"><?= $lang[18] ?></p>
                            <p class="w-full mt-2">n₁ = (<?= $n2 ?> * sin(<?= $detail['angle_second'] ?>)) / sin(<?= $detail['angle_first'] ?>)</p>
                            <p class="w-full mt-2">n₁ = <?= round($detail['jawab'], 6) ?></p>
                        <?php }else if($detail['calculation'] === "from2") { ?>
                            <div class="text-center">
                                <p class="text-[19px]"><strong><?= $lang[11] ?> 2 (n₂)</strong></p>
                                <p class="text-[21px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                    <strong class="text-blue">{{ round($detail['jawab'], 6) }}</strong>
                                </p>
                            </div>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[14] ?></strong></p>
                            <p class="w-full mt-2">n₁ <?= $lang[15] ?> 1 = <?= $n1 ?></p>
                            <p class="w-full mt-2"><?= $lang[13] ?> (θ₁) = <?= $detail['angle_first'] ?></p>
                            <p class="w-full mt-2"><?= $lang[19] ?> (θ₂) = <?= $detail['angle_second'] ?></p>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[16] ?></strong></p>
                            <p class="w-full mt-2"><?= $lang[17] ?> = (n₁ * sin(θ₁)) / sin(θ₂)</p>
                            <p class="w-full mt-2"><?= $lang[18] ?></p>
                            <p class="w-full mt-2">n₂ = (<?= $n1 ?> * sin(<?= $detail['angle_first'] ?>)) / sin(<?= $detail['angle_second'] ?>)</p>
                            <p class="w-full mt-2">n₂ = <?= round($detail['jawab'], 6) ?></p>
                        <?php }else if($detail['calculation'] === "from3") { ?>
                            <div class="text-center">
                                <p class="text-[19px]"><strong><?= $lang[13] ?> (θ₁)</strong></p>
                                <p class="font-s-21 bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                    <strong class="text-blue">{{ round(($detail['jawab'] * 57.2958), 6) }} deg</strong>
                                </p>
                            </div>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[14] ?></strong></p>
                            <p class="w-full mt-2">n₁ <?= $lang[15] ?> 1 = <?= $n1 ?></p>
                            <p class="w-full mt-2">n₂ <?= $lang[15] ?> 2 = <?= $n2 ?></p>
                            <p class="w-full mt-2"><?= $lang[19] ?> (θ₂) = <?= $detail['angle_second'] ?></p>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[16] ?></strong></p>
                            <p class="w-full mt-2"><?= $lang[17] ?> = sin<sup>-1</sup>((n₂ * sin(θ₂)) / n₁)</p>
                            <p class="w-full mt-2"><?= $lang[18] ?></p>
                            <p class="w-full mt-2">θ₁ =  sin<sup>-1</sup>((<?= $n2 ?> * sin(<?= $detail['angle_second'] ?>)) / <?= $n1 ?>);</p>
                            <p class="w-full mt-2">θ₁ = <?= round(($detail['jawab'] * 57.2958), 6) ?></p>
                        <?php }else{ ?>
                            <div class="text-center">
                                <p class="text-[19px]"><strong><?= $lang[19] ?> (θ₂)</strong></p>
                                <p class="text-[21px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                    <strong class="text-blue">{{ round(($detail['jawab'] * 57.2958), 6) }} deg</strong>
                                </p>
                            </div>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[14] ?></strong></p>
                            <p class="w-full mt-2">n₁ <?= $lang[15] ?> 1 = <?= $n1 ?></p>
                            <p class="w-full mt-2">n₂ <?= $lang[15] ?> 2 = <?= $n2 ?></p>
                            <p class="w-full mt-2"><?= $lang[13] ?> (θ₁) = <?= $detail['angle_first'] ?></p>
                            <p class="w-full mt-3 text-[19px]"><strong><?= $lang[16] ?></strong></p>
                            <p class="w-full mt-2"><?= $lang[17] ?> = sin<sup>-1</sup>((n₁ * sin(θ₁)) / n₂)</p>
                            <p class="w-full mt-2"><?= $lang[18] ?></p>
                            <p class="w-full mt-2">θ₁ =  sin<sup>-1</sup>((<?= $n1 ?> * sin(<?= $detail['angle_first'] ?>)) / <?= $n2 ?>)</p>
                            <p class="w-full mt-2">θ₁ = <?= round(($detail['jawab'] * 57.2958), 6) ?></p>
                        <?php } ?>
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
            const calculation = document.getElementById('calculation');
            const mediumIndex1 = document.getElementById('medium_index_1');
            const mediumIndex2 = document.getElementById('medium_index_2');
            const angle1 = document.getElementById('angle1');
            const angle2 = document.getElementById('angle2');
            const n1 = document.getElementById('n1');
            const n2 = document.getElementById('n2');
            const medium1 = document.getElementById('medium1');
            const medium2 = document.getElementById('medium2');

            function updateCalculationDisplay() {
                const method = calculation.value;
                if (method === "from1") {
                    mediumIndex2.style.display = 'block';
                    angle1.style.display = 'block';
                    angle2.style.display = 'block';
                    mediumIndex1.style.display = 'none';
                } else if (method === "from2") {
                    mediumIndex1.style.display = 'block';
                    angle1.style.display = 'block';
                    angle2.style.display = 'block';
                    mediumIndex2.style.display = 'none';
                } else if (method === "from3") {
                    mediumIndex2.style.display = 'block';
                    mediumIndex1.style.display = 'block';
                    angle2.style.display = 'block';
                    angle1.style.display = 'none';
                } else {
                    mediumIndex1.style.display = 'block';
                    mediumIndex2.style.display = 'block';
                    angle1.style.display = 'block';
                    angle2.style.display = 'none';
                }
            }

            function updateMediumIndex(value, element) {
                if (value === "vacuum") {
                    element.value = "1";
                } else if (value === "air") {
                    element.value = "1.000293";
                } else if (value === "water") {
                    element.value = "1.333";
                } else if (value === "ethanol") {
                    element.value = "1.36";
                } else if (value === "ice") {
                    element.value = "1.31";
                } else if (value === "acrylic") {
                    element.value = "1.49";
                } else if (value === "window") {
                    element.value = "1.52";
                } else if (value === "diamond") {
                    element.value = "2.419";
                } else {
                    element.value = "";
                }
            }

            calculation.addEventListener('change', updateCalculationDisplay);
            medium1.addEventListener('change', function() {
                updateMediumIndex(medium1.value, n1);
            });
            medium2.addEventListener('change', function() {
                updateMediumIndex(medium2.value, n2);
            });

            updateCalculationDisplay();
            updateMediumIndex(medium1.value, n1);
            updateMediumIndex(medium2.value, n2);
        });
    </script>
@endpush