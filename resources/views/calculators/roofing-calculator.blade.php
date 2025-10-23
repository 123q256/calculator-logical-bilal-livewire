<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
              
              
             <div class="space-y-2">
                <label for="length" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_units_dropdown')">{{ isset($_POST['length_units'])?$_POST['length_units']:'cm' }} ▾</label>
                    <input type="text" name="length_units" value="{{ isset($_POST['length_units'])?$_POST['length_units']:'cm' }}" id="length_units" class="hidden">
                    <div id="length_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_units', 'cm')">centimeters (cm)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_units', 'mm')">milimeters (mm)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_units', 'm')">meters (m)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_units', 'in')">inches (in)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_units', 'ft')">feet (ft)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_units', 'yd')">yards (yd)</p>
                    </div>
                </div>
             </div>
             <div class="space-y-2">
                <label for="width" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_units_dropdown')">{{ isset($_POST['width_units'])?$_POST['width_units']:'cm' }} ▾</label>
                    <input type="text" name="width_units" value="{{ isset($_POST['width_units'])?$_POST['width_units']:'cm' }}" id="width_units" class="hidden">
                    <div id="width_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'cm')">centimeters (cm)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'mm')">milimeters (mm)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'm')">meters (m)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'in')">inches (in)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'ft')">feet (ft)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'yd')">yards (yd)</p>
                    </div>
                </div>
             </div>

             <div class="space-y-2 relative">
                <label class="block text-sm font-medium text-gray-700">Insert Value</label>
                <input type="number" step="any" name="pitch" id="pitch" class="input" aria-label="input"  value="{{ isset($_POST['pitch'])?$_POST['pitch']:'6' }}" />
                <span class="input_unit text-blue">%</span>
            </div>
          
             <div class="space-y-2">
                <label for="price" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="relative w-full ">
                    <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="price_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_units_dropdown')">{{ isset($_POST['price_units'])?$_POST['price_units']:'mm²' }} ▾</label>
                    <input type="text" name="price_units" value="{{ isset($_POST['price_units'])?$_POST['price_units']:'mm²' }}" id="price_units" class="hidden">
                    <div id="price_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_units', 'mm²')">mm²</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_units', 'cm²')">cm²</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_units', 'm²')">m²</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_units', 'in²')">in²</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_units', 'ft²')">ft²</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('price_units', 'yd²')">yd²</p>
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
            <div class="rounded-lg  flex items-center ">
                <div class="w-full md:w-[50%] lg:w-[50%] my-2">
                    <div class="w-full font-s-18">
                        <table class="w-full">
                            <tr>
                                <td width="70%" class="border-b py-2"><strong>{{$lang['5']}}</strong></td>
                                <td class="border-b py-2">{{round($detail['roof_area'], 2)}} m²</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang['6']}}</strong></td>
                                <td class="border-b py-2">{{$currancy.round($detail['cost'], 2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang['7']}}</strong></td>
                                <td class="border-b py-2">{{round($detail['house_area'], 2)}} m²</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang['8']}}</strong></td>
                                <td class="border-b py-2">{{round($detail['pitch_deg'], 2)}} deg</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang['9']}}</strong></td>
                                <td class="border-b py-2">{{round($detail['slop'], 2)}} :12</td>
                            </tr>
                        </table>
                        <p class="mt-3 mb-1">{{$lang['10']}}</p>
                        <table class="w-full">
                            <tr>
                                <td width="70%" class="border-b py-2">mm²</td>
                                <td class="border-b py-2">{{round($detail['roof_area'] * 1000000, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">cm²</td>
                                <td class="border-b py-2">{{round($detail['roof_area'] * 10000, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">in²</td>
                                <td class="border-b py-2">{{round($detail['roof_area'] * 1550.0031, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">ft²</td>
                                <td class="border-b py-2">{{round($detail['roof_area'] * 10.7639, 2)}}</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">yd²</td>
                                <td class="border-b py-2">{{round($detail['roof_area'] * 1.19599, 2)}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3">
                   
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>