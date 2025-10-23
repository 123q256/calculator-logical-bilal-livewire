<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="width" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                    </div>
                    <div class="space-y-2">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height'])?$_POST['height']:'40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                    </div>
                <div class="space-y-2 relative">
                    <label for="block_size" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <select name="block_size" id="block_size" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["16 x 8 Block", "8 x 8 Block", "12 x 8 Block", "8 x 4 Block", "12 x 4 Block", "16 x 4 Block"];
                            $val = ["16x8", "8x8", "12x8", "8x4", "12x4", "16x4"];
                            optionsList($val,$name,isset($_POST['block_size'])?$_POST['block_size']:'12x8');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="block_price" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <input type="number" step="any" name="block_price" id="block_price" class="input" aria-label="input"  value="{{ isset($_POST['block_price'])?$_POST['block_price']: '1'}}" />
                    <span class="input-_nit text-blue">{{$currancy}}</span>
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
                        <div class="w-full  my-2">
                            <div class="col-lg-7 font-s-18">
                                <table class="w-100">
                                    <tr>
                                        <td width="70%" class="border-b py-2"><strong>{{$lang['5']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['blocks_needed']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['6']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$currancy.$detail['total_block_cost'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{ $detail['mortar_estimation']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['8']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{ round($detail['wall_area'] / 144, 2) }} ft<sup>2</sup></td>
                                    </tr>
                                </table>
                                <p class="font-s-20 mt-3 mb-2"><strong>{{$lang['9']}}</strong></p>
                                <table class="w-100">
                                    <tr>
                                        <td width="70%" class="border-b py-2">{{$lang['10']}} :</td>
                                        <td class="border-b py-2">{{round(($detail['wall_area'] / 144) * 0.0929, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['11']}} :</td>
                                        <td class="border-b py-2">{{round(($detail['wall_area'] / 144) * 0.0000000929, 5)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['12']}} :</td>
                                        <td class="border-b py-2">{{round(($detail['wall_area'] / 144)  * 144, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['13']}} :</td>
                                        <td class="border-b py-2">{{round(($detail['wall_area'] / 144) * 0.1111, 2)}}</td>
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