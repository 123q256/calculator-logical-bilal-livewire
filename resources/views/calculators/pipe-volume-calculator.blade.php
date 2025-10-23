<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1   gap-4">
                        <p class="px-2">{{$lang['1']}}</p>
                    </div>
                    <div class="grid grid-cols-1 mt-3  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="inner_diameter" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="inner_diameter" id="inner_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['inner_diameter'])?$_POST['inner_diameter']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="inner_diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('inner_diameter_unit_dropdown')">{{ isset($_POST['inner_diameter_unit'])?$_POST['inner_diameter_unit']:'cm' }} ▾</label>
                                <input type="text" name="inner_diameter_unit" value="{{ isset($_POST['inner_diameter_unit'])?$_POST['inner_diameter_unit']:'cm' }}" id="inner_diameter_unit" class="hidden">
                                <div id="inner_diameter_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[30%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'cm')">centimeters (cm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'mm')">milimeters (mm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'm')">meters (m)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'in')">inches (in)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'km')">kilometers (km)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'yd')">yard (yd)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inner_diameter_unit', 'mi')">miles (mi)</p>
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                                <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                                <div id="length_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[30%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yard (yd)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">miles (mi)</p>
                                </div>
                            </div>
                         </div>

                         <div class="space-y-2">
                            <label for="density" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density'])?$_POST['density']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }} ▾</label>
                                <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }}" id="density_unit" class="hidden">
                                <div id="density_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[30%] mt-1 right-0 hidden">
                                    @foreach (["kg/m³","kg/dm³","kg/L","g/mL","g/cm³","oz/cu in","lb/cu in","lb/cu ft","lb/US gal","g/L","g/dL","mg/L"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', '{{$name}}')">{{$name}}</p>
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
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['5']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['volume'],2)}} (cubic inch)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-2">{{$lang['6']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']/231,3)}} <span>(gallons)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']/16390,3)}} <span>(cu mm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']/61.0237,3)}} <span>(liters)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['weight'],2)}} (lb)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-2">{{$lang['6']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{round($detail['weight']/ 2.205,3)}} <span>(kg)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{round($detail['weight']*453600,3)}} <span>(mg)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{round($detail['weight']*45.36,3)}} <span>(dag)</span></td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>