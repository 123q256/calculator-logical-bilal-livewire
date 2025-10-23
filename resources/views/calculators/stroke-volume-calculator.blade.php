<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="Cardiac" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="Cardiac" id="Cardiac" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['Cardiac']) ? $_POST['Cardiac'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="Cardiac_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('Cardiac_unit_dropdown')">{{ isset($_POST['Cardiac_unit'])?$_POST['Cardiac_unit']:'/min l' }} ▾</label>
                        <input type="text" name="Cardiac_unit" value="{{ isset($_POST['Cardiac_unit'])?$_POST['Cardiac_unit']:'/min l' }}" id="Cardiac_unit" class="hidden">
                        <div id="Cardiac_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="Cardiac_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min mm³')">/min mm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min cm³')">/min cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min dm³')">/min dm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min in³')">/min in³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min ft³')">/min ft³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min yd³')">/min yd³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min ml')">/min ml</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min cl')">/min cl</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min l')">/min l</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min US gal')">/min US gal</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min UK gal')">/min UK gal</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min US fl oz')">/min US fl oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min UK fl oz')">/min UK fl oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min cups')">/min cups</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min tbsp')">/min tbsp</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min tsp')">/min tsp</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min US qt')">/min US qt</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min UK qt')">/min UK qt</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min US pt')">/min US pt</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Cardiac_unit', '/min UK pt')">/min UK pt</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="heart" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="heart" id="heart" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heart)?request()->heart:'20' }}" />
                        <span class="text-blue input_unit">bpm</span>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in">
                    <label for="height_ft" class="label">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft)?request()->height_ft:'10' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in">
                    <label for="height_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'mm' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'mm' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'mm' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                            <p value="mm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'mm')">millimeters (mm)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'm')">meters (m)</p>
                            <p value="km" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'km')">kilometers (km)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'in')">inches (in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft')">feet (ft)</p>
                            <p value="yd" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'yd')">yards (yd)</p>
                            <p value="mi" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'mi')">miles (mi)</p>
                            <p value="nmi" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'nmi')">nautical miles (nmi)</p>
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="m/cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'm/cm')">meters / centimeters (m/cm)</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6 h_cm">
                    <label for="height_cm" class="label">{{ $lang['5'] }} <span class="text-blue height_unit">(mm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'mm' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'mm' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p  value="mm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'mm')">millimeters (mm)</p>
                            <p  value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                            <p  value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm')">meters (m)</p>
                            <p  value="km" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'km')">kilometers (km)</p>
                            <p  value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'in')">inches (in)</p>
                            <p  value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft')">feet (ft)</p>
                            <p  value="yd" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'yd')">yards (yd)</p>
                            <p  value="mi" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'mi')">miles (mi)</p>
                            <p  value="nmi" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'nmi')">nautical miles (nmi)</p>
                            <p  value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p  value="m/cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm/cm')">meters / centimeters (m/cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="label">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'µg')">micrograms (µg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 't')">tons (t)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'gr')">grain (gr)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'dr')">dram (dr)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'oz')">ounces (oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'st')">stone (st)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'US ton')">US ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'long ton')">long ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'Earths')">Earths</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'me')">me</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'u')">u</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'oz t')">oz t</p>

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
                    <div class="w-full mt-2">
                        <div class="bg-sky border rounded">
                            <div class="w-full px-3 py-2">
                                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['1'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['stroke_volume'], 4) }}</strong>
                                            <span class="text-green-500 text-[18px]">l</span>
                                        </p>
                                    </div>
                                    <div class="col-span-12 md:col-span-2 lg:col-span-2 hidden md:block lg:block justify-center">
                                        <div class="border" style="width: 1px"></div>
                                    </div>
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5 ps-md-4">
                                        <p><strong>{{ $lang['4'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['bsa'], 4) }}</strong>
                                            <span class="text-green-500 text-[18px]">m²</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full  px-3 py-2">
                                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['7'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['stroke_val_index'], 4) }}</strong>
                                            <span class="text-green-500 text-[18px]">l/(min·m²)</span>
                                        </p>
                                    </div>
                                    <div class="col-span-12 md:col-span-2 lg:col-span-2 hidden md:block lg:block justify-center">
                                        <div class="border" style="width: 1px"></div>
                                    </div>
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5 ps-md-4">
                                        <p><strong>{{ $lang['8'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['stroke_index'], 4) }}</strong>
                                            <span class="text-green-500 text-[18px]">l/m²</span>
                                        </p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in' || val == 'm/cm') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                        let placeholder = val.split('/')
                        document.getElementById('height_ft').setAttribute('placeholder', placeholder[0])
                        document.getElementById('height_in').setAttribute('placeholder', placeholder[1])
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit').textContent = '('+val+')';
                        document.getElementById('height_cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            @if(isset($detail) || isset($error))
                var val = document.getElementById('unit_ft_in').value;
                if (val == 'ft/in' || val == 'm/cm') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                    let placeholder = val.split('/')
                    document.getElementById('height_ft').setAttribute('placeholder', placeholder[0])
                    document.getElementById('height_in').setAttribute('placeholder', placeholder[1])
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                    document.querySelector('.height_unit').textContent = '('+val+')';
                    document.getElementById('height_cm').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>