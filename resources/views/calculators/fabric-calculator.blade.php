<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-lg-6 pe-lg-4">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="fabric" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fabric" id="fabric" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fabric']) ? $_POST['fabric'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fabric_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fabric_unit_dropdown')">{{ isset($_POST['fabric_unit'])?$_POST['fabric_unit']:'cm' }} ▾</label>
                        <input type="text" name="fabric_unit" value="{{ isset($_POST['fabric_unit'])?$_POST['fabric_unit']:'cm' }}" id="fabric_unit" class="hidden">
                        <div id="fabric_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fabric_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'ft')">feet (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fabric_unit', 'yd')">yard (yd)</p>
                        </div>
                     </div>
                </div>

                <div class="col-12 mt-0 mt-lg-2">
                    <label for="width" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feet (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yard (yd)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yard (yd)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="piece" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="w-100 py-2"> 
                        <input type="number" step="any" name="piece" id="piece" class="input" aria-label="input"  value="{{ isset($_POST['piece'])?$_POST['piece']:'4' }}" />
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2"> 
                        <select name="unit" id="unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                    $name = ["mm", "cm", "m", "km", "in", "ft", "yd"];
                                    $val = ["mm", "cm", "m", "km", "in", "ft", "yd"];
                                optionsList($val,$name,isset($_POST['unit'])?$_POST['unit']: 'm' );
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-4 flex items-center justify-center">
                <img src="{{asset('images/fabric_new.webp')}}" alt="Fabric" class="max-width" width="260px" height="260px">
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <p class="text-[20px] mt-3 mb-2"><strong>{{$lang['6']}}</strong></p>
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2">{{$lang['7']}} :</td>
                                    <td class="border-b py-2">{{$detail['answer'].$detail['unit']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b pt-4 pb-2">{{$lang['8']}} :</td>
                                    <td class="border-b pt-4 pb-2">{{$detail['down'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['9']}} :</td>
                                    <td class="border-b py-2">{{$detail['across'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <p class="text-[20px] my-3"><strong>{{ $lang['10'] }}</strong></p>
                            <p class="my-2">{{ $lang['11'] }}.</p>
                            <p class="my-2">{{ $lang['9'] }} = {{ $lang['1'] }} / {{ $lang['2'] }}</p>
                            <p class="my-2">{{ $lang['9'] }} = {{ $detail['fabric'] }} /{{  $detail['width'] }}</p>
                            <p class="my-2">{{ $lang['9'] }} = {{ $detail['across'] }}</p>
                            <p class="my-2">{{ $lang['12'] }}.</p>
                            <p class="my-2">{{ $lang['8'] }} = {{ $lang['4'] }} / {{ $lang['9'] }}</p>
                            <p class="my-2">{{ $lang['8'] }} = {{ $detail['piece'] }} / {{ $detail['across'] }}</p>
                            <p class="my-2">{{ $lang['8'] }} = {{ $detail['down'] }}</p>
                            <p class="my-2">{{ $lang['13'] }}.</p>
                            <p class="my-2">{{ $lang['14'] }} = {{ $lang['3'] }} *{{ $lang['8'] }}</p>
                            <p class="my-2">{{ $lang['14'] }} = {{ $detail['length'] }} * {{ $detail['down'] }}</p>
                            <p class="my-2">{{ $lang['14'] }} = {{ $detail['answer'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>