<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="t_fluid" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="t_fluid" id="t_fluid" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'], $lang['3']];
                                $val = ["ls", "gas"];
                                optionsList($val,$name,isset($_POST['t_fluid'])?$_POST['t_fluid']:'ls');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="density" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density']) ? $_POST['density'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }} ▾</label>
                        <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }}" id="density_unit" class="hidden">
                        <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/m³')">kg/m³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/ft³')">lb/ft³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/yd³')">lb/yd³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/cm³')">g/cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/cm³')">kg/cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'mg/cm³')">mg/cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/m³')">g/m³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/dm³')">g/dm³</p>
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
                            $request = request();
                            $t_fluid = $request->t_fluid;
                            $density = $request->density;
                            $density_unit = $request->density_unit;
                        @endphp
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[20px]">
                                    <strong>{{ $lang['5'] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $t_fluid == 'ls' ? $detail['gravity'] : $detail['gs_gravity'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="col-12 mt-2 text-center"><?=$lang[6]?></p>
                            <p class="col-12 mt-3 text-[20px] text-blue"><?=$lang[6]?></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full" style="border-collapse: collapse">
                                    <tr class="bg-[#F6FAFC]">
                                        <th class="p-2 border text-center text-blue"><?= $lang['8'] ?></th>
                                        <th class="p-2 border text-center text-blue"><?= $lang['9'] ?></th>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['10'] ?></td>
                                        <td class="p-2 border text-center">0.12</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['11'] ?></td>
                                        <td class="p-2 border text-center">0.6 - 0.9</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['12'] ?></td>
                                        <td class="p-2 border text-center">0.789</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['13'] ?></td>
                                        <td class="p-2 border text-center">0.91</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['14'] ?></td>
                                        <td class="p-2 border text-center">0.92</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['15'] ?></td>
                                        <td class="p-2 border text-center">1.0</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['16'] ?></td>
                                        <td class="p-2 border text-center">1.06</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['17'] ?></td>
                                        <td class="p-2 border text-center">2.17</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['18'] ?></td>
                                        <td class="p-2 border text-center">2.7</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['19'] ?></td>
                                        <td class="p-2 border text-center">3.15</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['20'] ?></td>
                                        <td class="p-2 border text-center">11.34</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['21'] ?></td>
                                        <td class="p-2 border text-center">13.6</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['22'] ?></td>
                                        <td class="p-2 border text-center">19.05</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['23'] ?></td>
                                        <td class="p-2 border text-center">19.32</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['24'] ?></td>
                                        <td class="p-2 border text-center">22.59</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?= $lang['25'] ?></td>
                                        <td class="p-2 border text-center">8.96</td>
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
        // Function to handle changes based on the fluid type
        function handleFluidChange(fluid) {
            var densityUnits = document.querySelectorAll('.density_unit1');

            if (fluid === 'gas') {
                densityUnits.forEach(function(el) { el.style.display = 'none'; });
            } else {
                densityUnits.forEach(function(el) { el.style.display = 'block'; });
            }
        }

        // Initial setup based on the current value of #t_fluid
        var fluid = document.getElementById('t_fluid').value;
        handleFluidChange(fluid);

        // Add event listener to handle changes when #t_fluid value changes
        document.getElementById('t_fluid').addEventListener('change', function() {
            var fluid = this.value;
            handleFluidChange(fluid);
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>