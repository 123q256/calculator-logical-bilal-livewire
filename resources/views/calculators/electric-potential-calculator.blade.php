<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-2">
                <div class="col-span-12 mx-auto px-2">
                    <label for="potential_type" class="label">{{ $lang[1] }}</label>
                    <div class="w-full py-2 position-relative">
                        <select name="potential_type" id="potential_type" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4']];
                                $val = ["single-point","multi-point","difference"];
                                optionsList($val,$name,isset($_POST['potential_type'])?$_POST['potential_type']:'single-point');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 text-center my-3">
                    <img class="set_img mx-auto" src="<?=url('images/multi.png')?>" alt="Potential type image" width="200px" height="100%">
                </div>
                <div class="col-span-6 charge">
                    <label for="charge" class="label">{{ $lang[5] }} (q):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="charge" id="charge" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge'])?$_POST['charge']:'0.0000004' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="charge_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_unit_dropdown')">{{ isset($_POST['charge_unit'])?$_POST['charge_unit']:'PC' }} ▾</label>
                       <input type="text" name="charge_unit" value="{{ isset($_POST['charge_unit'])?$_POST['charge_unit']:'PC' }}" id="charge_unit" class="hidden">
                       <div id="charge_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="charge_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'PC')">PC</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'nC')">nC</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'gon')">gon</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'μC')">μC</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'mC')">mC</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'C')">C</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'e')">e</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-span-6 distance">
                    <label for="distance" class="label">{{ $lang[5] }} (q):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance'])?$_POST['distance']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'nm' }} ▾</label>
                       <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'nm' }}" id="distance_unit" class="hidden">
                       <div id="distance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'nm')">nm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'μm')">μm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'mm')">mm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'yd')">yd</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-span-6 U">
                    <label for="U" class="label">{{ $lang[5] }} (q):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="U" id="U" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['U'])?$_POST['U']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="U_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('U_unit_dropdown')">{{ isset($_POST['U_unit'])?$_POST['U_unit']:'J' }} ▾</label>
                       <input type="text" name="U_unit" value="{{ isset($_POST['U_unit'])?$_POST['U_unit']:'J' }}" id="U_unit" class="hidden">
                       <div id="U_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="U_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'J')">J</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'kJ')">kJ</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'MJ')">MJ</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'Wh')">Wh</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'kWh')">kWh</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'kWh')">kWh</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'kcal')">kcal</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('U_unit', 'eV')">eV</p>
                       </div>
                    </div>
                  </div>
                
                <div class="col-span-6 points">
                    <label for="points" class="label">{{ $lang[8] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" min="1" max="20" name="points" id="points" class="input" value="{{ isset($_POST['points'])?$_POST['points']:'2' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 E">
                    <label for="E" class="label">{{ $lang[9] }} (ϵᵣ):</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" min="1" max="20" name="E" id="E" class="input" value="{{ isset($_POST['E'])?$_POST['E']:'1' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 point_charge">
                 <div class="grid grid-cols-12  mt-3  gap-2">
                     <div class="col-span-6 px-2">
                        <label for="Q0" class="label"><?=$lang['5']?> 1 (q<sub class="text-blue">1</sub>):</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="Q[0]" id="Q0" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="unit_Q0" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_Q0_dropdown')">{{ isset($_POST['unit_Q[0]'])?$_POST['unit_Q[0]']:'mC' }} ▾</label>
                           <input type="text" name="unit_Q[0]" value="{{ isset($_POST['unit_Q[0]'])?$_POST['unit_Q[0]']:'mC' }}" id="unit_Q0" class="hidden">
                           <div id="unit_Q0_dropdown" class="unit_Q0  absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_Q0">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'PC')">PC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'nC')">nC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'mm')">mm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'μC')">μC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'mC')">mC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'C')">C</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q0', 'e')">e</p>
                           </div>
                        </div>
                      </div>
                      <div class="col-span-6 px-2">
                        <label for="R0" class="label"><?=$lang['6']?> 1 (r<sub class="text-blue">1</sub>):</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="R[0]" id="R0" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="unit_R0" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_R0_dropdown')">{{ isset($_POST['unit_R[0]'])?$_POST['unit_R[0]']:'mC' }} ▾</label>
                           <input type="text" name="unit_R[0]" value="{{ isset($_POST['unit_R[0]'])?$_POST['unit_R[0]']:'mC' }}" id="unit_R0" class="hidden">
                           <div id="unit_R0_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_R0">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'PC')">PC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'nC')">nC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'mm')">mm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'μC')">μC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'mC')">mC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'C')">C</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R0', 'e')">e</p>
                           </div>
                        </div>
                      </div>
                    </div>
                 <div class="grid grid-cols-12  mt-3  gap-2">
                    <div class="col-span-6 px-2">
                        <label for="Q1" class="label"><?=$lang['5']?> 2 (q<sub class="text-blue">2</sub>):</label>
                            <div class="relative w-full mt-[7px]">
                            <input type="number" name="Q[1]" id="Q1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_Q1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_Q1_dropdown')">{{ isset($_POST['unit_Q[1]'])?$_POST['unit_Q[1]']:'mC' }} ▾</label>
                            <input type="text" name="unit_Q[1]" value="{{ isset($_POST['unit_Q[1]'])?$_POST['unit_Q[1]']:'mC' }}" id="unit_Q1" class="hidden">
                            <div id="unit_Q1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_Q1">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'PC')">PC</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'nC')">nC</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'mm')">mm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'μC')">μC</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'mC')">mC</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'C')">C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_Q1', 'e')">e</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-span-6 px-2">
                            <label for="R1" class="label"><?=$lang['6']?> 2 (r<sub class="text-blue">2</sub>):</label>
                                <div class="relative w-full mt-[7px]">
                                <input type="number" name="R[1]" id="R1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_R1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_R1_dropdown')">{{ isset($_POST['unit_R[1]'])?$_POST['unit_R[1]']:'mC' }} ▾</label>
                                <input type="text" name="unit_R[1]" value="{{ isset($_POST['unit_R[1]'])?$_POST['unit_R[1]']:'mC' }}" id="unit_R1" class="hidden">
                                <div id="unit_R1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_R1">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'PC')">PC</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'nC')">nC</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'mm')">mm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'μC')">μC</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'mC')">mC</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'C')">C</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_R1', 'e')">e</p>
                                </div>
                                </div>
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
                        <div class="w-full">
                            @php
                                $request = request();
                                $potential_type = $request->potential_type;
                            @endphp
                            <div class="text-center">
                                <p class="text-[18px]"><strong><?= $potential_type == 'difference' ? $lang['10'].' (∆V)' : $lang['11'].' (V)' ?></strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-blue">{!! $detail['answer'] !!}</strong>
                                </p>
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
            const potentialType = document.getElementById('potential_type');
            const pointsInput = document.getElementById('points');
            const setImage = document.querySelector('.set_img');
            const chargeElements = document.querySelectorAll('.charge');
            const distanceElements = document.querySelectorAll('.distance');
            const eElements = document.querySelectorAll('.E');
            const uElements = document.querySelectorAll('.U');
            const pointsElements = document.querySelectorAll('.points');
            const pointChargeContainer = document.querySelector('.point_charge');

            function updatePotentialType() {
                const value = potentialType.value;
                if (value === "single-point") {
                    setImage.src = "{{url('images/single.png')}}";
                    setImage.style.display = 'block';
                    showElements(chargeElements, distanceElements, eElements);
                    hideElements(uElements, pointsElements, pointChargeContainer);
                } else if (value === "multi-point") {
                    setImage.src = "{{url('images/multi.png')}}";
                    setImage.style.display = 'block';
                    showElements(pointsElements, pointChargeContainer, eElements);
                    hideElements(chargeElements, distanceElements, uElements);
                } else if (value === "difference") {
                    setImage.style.display = 'none';
                    showElements(chargeElements, eElements, uElements);
                    hideElements(distanceElements, pointsElements, pointChargeContainer);
                }
            }

            function showElements(...elements) {
                elements.forEach(element => {
                    if (element.length !== undefined) {
                        element.forEach(el => el.style.display = 'block');
                    } else {
                        element.style.display = 'block';
                    }
                });
            }

            function hideElements(...elements) {
                elements.forEach(element => {
                    if (element.length !== undefined) {
                        element.forEach(el => el.style.display = 'none');
                    } else {
                        element.style.display = 'none';
                    }
                });
            }

            potentialType.addEventListener('change', updatePotentialType);

            pointsInput.addEventListener('input', function() {
                pointChargeContainer.style.display = 'block';
                pointChargeContainer.innerHTML = '';
                const points = pointsInput.value;
                for (let i = 0; i < points; i++) {
                    let num = i + 1;
                    let html = `<div class="row"><div class="col-lg-6 px-2">
                            <label for="Q${i}" class="label"><?=$lang['5']?> ${num} (q<sub class="text-blue">${num}</sub>):</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="Q[${i}]" id="Q${i}" class="input" aria-label="input" placeholder="00" />
                                <label for="unit_Q${i}" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['unit_Q[${i}]'])?$_POST['unit_Q[${i}]']:'mC' }} ▾</label>
                                <input type="text" name="unit_Q[${i}]" value="{{ isset($_POST['unit_Q[${i}]'])?$_POST['unit_Q[${i}]']:'mC' }}" id="unit_Q${i}" class="d-none">
                                <div class="units unit_Q${i} d-none" to="unit_Q${i}">
                                    <p value="PC">PC</p>
                                    <p value="nC">nC</p>
                                    <p value="mm">mm</p>
                                    <p value="μC">μC</p>
                                    <p value="mC">mC</p>
                                    <p value="C">C</p>
                                    <p value="e">e</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 px-2">
                            <label for="R${i}" class="label"><?=$lang['6']?> ${num} (r<sub class="text-blue">${num}</sub>):</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="R[${i}]" id="R${i}" class="input" aria-label="input" placeholder="00" />
                                <label for="unit_R${i}" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['unit_R[${i}]'])?$_POST['unit_R[${i}]']:'mC' }} ▾</label>
                                <input type="text" name="unit_R[${i}]" value="{{ isset($_POST['unit_R[${i}]'])?$_POST['unit_R[${i}]']:'mC' }}" id="unit_R${i}" class="d-none">
                                <div class="units unit_R${i} d-none" to="unit_R${i}">
                                    <p value="PC">PC</p>
                                    <p value="nC">nC</p>
                                    <p value="mm">mm</p>
                                    <p value="μC">μC</p>
                                    <p value="mC">mC</p>
                                    <p value="C">C</p>
                                    <p value="e">e</p>
                                </div>
                            </div>
                        </div></div>`;
                    pointChargeContainer.insertAdjacentHTML('beforeend', html);
                }
            });

            updatePotentialType();
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>