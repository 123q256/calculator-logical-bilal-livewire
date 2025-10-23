<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['cal_by'] }}:</label>
                    <select name="method" id="method" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['length']." ".$lang['and']." ".$lang['width'],$lang['area']];
                                $val = ["lw","area"];
                            optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'lw');
                        @endphp
                    </select>
                </div>

                <div class="space-y-2 n_area {{ isset($_POST['method']) && $_POST['method'] !== 'lw' ? 'd-none': 'd-block' }}">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['length'] }} (d):</label>
                    <div class="relative w-full ">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'ft' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'ft' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[40%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 n_area {{ isset($_POST['method']) && $_POST['method'] !== 'lw' ? 'd-none': 'd-block' }}">
                    <label for="width" class="font-s-14 text-blue">{{ $lang['width'] }} (f):</label>
                    <div class="relative w-full ">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'ft' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'ft' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[40%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'km')">kilometers (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mi')">miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2  area {{ isset($_POST['method']) && $_POST['method'] !== 'lw' ? 'd-block': 'd-none' }}">
                    <label for="area" class="font-s-14 text-blue">{{ $lang['area'] }} (f):</label>
                    <div class="relative w-full ">
                        <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'5000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'ft²' }} ▾</label>
                        <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'ft²' }}" id="area_unit" class="hidden">
                        <div id="area_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[40%] mt-1 right-0 hidden">
                            @php
                            $name = ["m²","km²","ft²","yd²","mi²","a","da","ha","ac","soccer fields"];
                            foreach ($name as $value) {
                                echo "<p class='p-1 hover:bg-gray-100 cursor-pointer' onclick=\"setUnit('area_unit', '$value')\">$value</p>";
                            }
                        @endphp
                        

                        </div>
                    </div>
                 </div>

                <div class="space-y-2 relative price {{ isset($_POST['method']) && $_POST['method'] !== 'lw' ? 'col-12': 'col-lg-6 ps-lg-4' }}">
                    <label for="area" class="font-s-14 text-blue">{{ $lang['price'] }} :</label>
                    <input type="number" step="any" name="price" id="price" class="input" aria-label="input" value="{{ isset($_POST['price'])?$_POST['price']:'5' }}" />
                    <span class="input_unit text-blue">{{$currancy}}</span>
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
                            if(isset($detail['meter'])){
                                $rolls_unit = "(1 m²)";
                                $pallets_unit = "(40 m²)";
                                $total_area_unit = "M²";
                                $acres_unit = "Hectares";
                            }else{
                                $rolls_unit = "(10 ft²)";
                                $pallets_unit = "(450 ft²)";
                                $total_area_unit = "Ft²";
                                $acres_unit = "Acres";
                            }
                        @endphp
                        <div class="w-full my-2">
                            <div class="col-lg-6">
                                <p class="font-s-20 my-2">
                                    <strong>{{$lang['sod']}}</strong>
                                </p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="border-b py-2">
                                            {{ $detail['rolls'] }} :</td>
                                        <td class="border-b py-2">  {{$lang['rolls'] . $rolls_unit}}</td>
                                    </tr>
                                    <tr>
                                        <td width="60%" class="border-b py-2">
                                            {{ $detail['pallets'] }} :</td>
                                        <td class="border-b py-2"> {{$lang['pallets'] . $pallets_unit}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                            <div class="col-12 my-3">
                                <div class="col-lg-6">
                                    <p class="font-s-20 my-2">
                                        <strong>{{$lang['total']." ".$lang['area']}}</strong>
                                    </p>
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                    <table class="w-100 font-s-18">
                                        <tr>
                                            <td width="60%" class="border-b py-2">
                                                {{ $detail['total_area'] }} :</td>
                                            <td class="border-b py-2"> {{$total_area_unit}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                {{ $detail['acres'] }} :</td>
                                            <td class="border-b py-2">  {{$acres_unit}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            </div>
                            @if (isset($detail['cost']))
                                <div class="col-lg-6">
                                    <p class="font-s-20 my-2">
                                        <strong>{{$lang['cost']}}</strong>
                                    </p>
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                    <table class="w-100 font-s-18">
                                        <tr>
                                            <td width="60%" class="border-b py-2"> {{$lang['total']." ".$lang['cost']}} :</td>
                                            <td class="border-b py-2">
                                                {{$currancy.$detail['cost']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"> {{$lang['cost']}} per sq ft :</td>
                                            <td class="border-b py-2">
                                                {{$currancy.$detail['cost_ft2'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('method').addEventListener('change',function(){
            var method = this.value;
            var area = document.querySelector('.area');
            var price = document.querySelector('.price');
            var n_area = document.querySelectorAll('.n_area');
            if(method == 'lw'){
                console.log(method);
                area.classList.add('d-none');
                area.classList.remove('d-block');
                price.classList.add('col-lg-6');
                price.classList.add('ps-lg-4');
                n_area.forEach(element => {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
            }else{
                area.classList.add('d-block');
                area.classList.remove('d-none');
                price.classList.remove('col-lg-6');
                price.classList.remove('ps-lg-4');
                n_area.forEach(element => {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
            }
        })
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>