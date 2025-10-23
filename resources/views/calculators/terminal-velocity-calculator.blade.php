<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   mt-3  gap-4">

        <div class="col-span-6">
            <div class="grid grid-cols-12   mt-3  gap-4">
                <div class="col-span-12">
                    <label for="shapes" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="shapes" id="shapes" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']];
                                $val = ["1","2","3","4","5","6","7"];
                                optionsList($val,$name,isset($_POST['shapes'])?$_POST['shapes']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="mass" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass'])?$_POST['mass']:'75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }} ▾</label>
                       <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }}" id="mass_unit" class="hidden">
                       <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">mg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">g</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 't')">t</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'gr')">gr</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz')">oz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lb')">lb</p>
                       </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="col-span-6 text-center flex items-center justify-center">
            <img src="<?=url('images/sph.png')?>" alt="Flow Rate Calculator" width="130" height="130" class="change_img"> 
        </div>
        <div class="col-span-6 px-2">
            <label for="area" class="font-s-14 text-blue">{{ $lang['3'] }} (A):</label>
            <div class="relative w-full mt-[7px]">
               <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
               <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m²' }} ▾</label>
               <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m²' }}" id="area_unit" class="hidden">
               <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mm²')">mm²</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">cm²</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">m²</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">in²</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">yd²</p>
               </div>
            </div>
          </div>
         
     
        <div class="col-span-6 px-2">
            <label for="drag_coefficient" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
            <div class="w-100 py-2 position-relative">
                <input type="number" step="any" name="drag_coefficient" id="drag_coefficient" class="input dc" value="{{ isset($_POST['drag_coefficient'])?$_POST['drag_coefficient']:'0.7' }}" aria-label="input" placeholder="00" />
            </div>
        </div>
        <div class="col-span-6 px-2">
            <label for="density" class="font-s-14 text-blue">{{ $lang['5'] }} (ρ):</label>
            <div class="relative w-full mt-[7px]">
               <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density'])?$_POST['density']:'75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
               <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }} ▾</label>
               <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }}" id="density_unit" class="hidden">
               <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/m³')">kg/m³</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb cu/ft')">lb cu/ft</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/cm³')">g/cm³</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/cm³')">kg/cm³</p>
               </div>
            </div>
          </div>
          <div class="col-span-6 px-2">
            <label for="gravity" class="font-s-14 text-blue">{{ $lang['6'] }} (g):</label>
            <div class="relative w-full mt-[7px]">
               <input type="number" name="gravity" id="gravity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['gravity'])?$_POST['gravity']:'75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
               <label for="gravity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('gravity_unit_dropdown')">{{ isset($_POST['gravity_unit'])?$_POST['gravity_unit']:'m/s²' }} ▾</label>
               <input type="text" name="gravity_unit" value="{{ isset($_POST['gravity_unit'])?$_POST['gravity_unit']:'m/s²' }}" id="gravity_unit" class="hidden">
               <div id="gravity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="gravity_unit">
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'm/s²')">m/s²</p>
                   <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'ft/s²')">ft/s²</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang[14] }}</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['terminal_velocity'],5) }} (m/s)</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang[15] }}</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['drag_coefficient_area'],5) }} (m²)</strong></td>
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
        function shapes() {
            var w = document.getElementById('shapes').value;
            
            if (w == "1") {
                updateShape("0.47", "<?=url('images/sph.png')?>");
            } else if (w == "2") {
                updateShape("0.389", "<?=url('images/golfball.svg')?>");
            } else if (w == "3") {
                updateShape("0.3275", "<?=url('images/baseball.svg')?>");
            } else if (w == "4") {
                updateShape("0.42", "<?=url('images/halfsphere.png')?>");
            } else if (w == "5") {
                updateShape("1.05", "<?=url('images/cubee.png')?>");
            } else if (w == "6") {
                updateShape("0.8", "<?=url('images/angledcube.png')?>");
            } else if (w == "7") {
                updateShape("0.04", "<?=url('images/streamlinedbody.png')?>");
            }
        }

        function updateShape(dcValue, imgUrl) {
            var dcElements = document.querySelectorAll('.dc');
            dcElements.forEach(function(element) {
                element.value = dcValue;
            });
            var changeImgElements = document.querySelectorAll('.change_img');
            changeImgElements.forEach(function(element) {
                element.src = imgUrl;
            });
        }

        shapes();

        document.getElementById('shapes').addEventListener('change', shapes);
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>