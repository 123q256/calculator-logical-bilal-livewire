<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="area" class="font-s-14 text-blue">{{ $lang[1] }} (A):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'mm²' }} ▾</label>
                       <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'mm²' }}" id="area_unit" class="hidden">
                       <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mm²')">mm²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">cm²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">m²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">in²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">ft²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">yd²</p>
                       </div>
                    </div>
                  </div>
                <div class="col-span-6">
                    <label for="permittivity" class="font-s-14 text-blue">{{ $lang[2] }} (ε):</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="permittivity" id="permittivity" class="input" value="{{ isset($_POST['permittivity'])?$_POST['permittivity']:'0.000000000008854' }}" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">F/m</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="distance" class="font-s-14 text-blue">{{ $lang[3] }} (s):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance'])?$_POST['distance']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="dis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit_dropdown')">{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'mm' }} ▾</label>
                       <input type="text" name="dis_unit" value="{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'mm' }}" id="dis_unit" class="hidden">
                       <div id="dis_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'mm')">mm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'yd')">yd</p>
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
                            <p class="w-full text-[18px]">{{ $lang[4] }}</p>
                            <div class="w-full  md:w-[50%] lg:w-[50%] mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['mf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">mF</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['f_ans'] }}</strong></td>
                                        <td class="p-2 border-b">F</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['microf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">μF</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['nf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">nF</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['pf_ans'] }}</strong></td>
                                        <td class="p-2 border-b">pF</td>
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
    
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>