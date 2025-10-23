<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
        
            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3  gap-4">
                  

                    <div class="col-span-12">
                        <label for="type" class="label cat">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" name="type" id="type" aria-label="input select">                        
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['12'],$lang['13']];
                                    $val = ["inside","outside"];
                                    optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'inside');
                                @endphp
                            </select>
                        </div>
                    </div> 
                    <div class="col-span-12">
                        <label for="top" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="top" id="top" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['top']) ? $_POST['top'] : '31' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="t_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_units_dropdown')">{{ isset($_POST['t_units'])?$_POST['t_units']:'cm' }} ▾</label>
                            <input type="text" name="t_units" value="{{ isset($_POST['t_units'])?$_POST['t_units']:'cm' }}" id="t_units" class="hidden">
                            <div id="t_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12">
                        <label for="width" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '31' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="w_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_units_dropdown')">{{ isset($_POST['w_units'])?$_POST['w_units']:'cm' }} ▾</label>
                            <input type="text" name="w_units" value="{{ isset($_POST['w_units'])?$_POST['w_units']:'cm' }}" id="w_units" class="hidden">
                            <div id="w_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="w_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12">
                        <label for="bottom" class="label">{{ $lang['4'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="bottom" id="bottom" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bottom']) ? $_POST['bottom'] : '42' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="b_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('b_units_dropdown')">{{ isset($_POST['b_units'])?$_POST['b_units']:'cm' }} ▾</label>
                            <input type="text" name="b_units" value="{{ isset($_POST['b_units'])?$_POST['b_units']:'cm' }}" id="b_units" class="hidden">
                            <div id="b_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="b_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_units', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12">
                        <label for=" h_left" class="label">{{ $lang['5'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="h_left" id="h_left" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h_left']) ? $_POST['h_left'] : '42' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="l_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('l_units_dropdown')">{{ isset($_POST['l_units'])?$_POST['l_units']:'cm' }} ▾</label>
                            <input type="text" name="l_units" value="{{ isset($_POST['l_units'])?$_POST['l_units']:'cm' }}" id="l_units" class="hidden">
                            <div id="l_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="l_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12">
                    <img class="max-width mt-lg-5" src="{{asset('images/blind_size.webp')}}" alt="Blind" width="300px" height="200px">
                    </div>
                    <div class="col-span-12">
                        <label for="h_center" class="label">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="h_center" id="h_center" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h_center']) ? $_POST['h_center'] : '50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="c_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_units_dropdown')">{{ isset($_POST['c_units'])?$_POST['c_units']:'cm' }} ▾</label>
                            <input type="text" name="c_units" value="{{ isset($_POST['c_units'])?$_POST['c_units']:'cm' }}" id="c_units" class="hidden">
                            <div id="c_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_units', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12">
                        <label for=" h_right" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="h_right" id="h_right" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h_right']) ? $_POST['h_right'] : '50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="r_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('r_units_dropdown')">{{ isset($_POST['r_units'])?$_POST['r_units']:'cm' }} ▾</label>
                            <input type="text" name="r_units" value="{{ isset($_POST['r_units'])?$_POST['r_units']:'cm' }}" id="r_units" class="hidden">
                            <div id="r_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="r_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_units', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
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
                        @php
                            $width = round($detail['blind_width'], 2);
                            $lenght = round($detail['blind_lenght'], 2);   
                        @endphp
                        <div class="w-full md:w-[60%] lg:w-[60%]   text-[18px]">
                            <table class="w-100">
                                <tr>
                                    <td width="60%" class="border-b py-2">
                                        {{ $lang['8'] }}</td>
                                    <td class="border-b py-2">{{ $width }} in</td>
                                </tr>
                            </table>
                            @if($detail['type'] == 'inside')
                                <table class="w-100">
                                    <tr>
                                        <td width="60%" class="border-b py-2">
                                           {{ $lang['10'] }} </td>
                                        <td class="border-b py-2">{{ round($detail['s_lenght'],2) }} in</td>
                                    </tr>
                                </table>
                            @endif
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2">
                                        {{ $lang['9'] }}</td>
                                    <td class="border-b py-2">{{ $lenght }} in</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  font-s-18">
                            <p class="text-[20px] text-center mt-3"><strong>{{$lang['11'] }}</strong></p>
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2">{{ $lang['8'] }}</td>
                                    <td class="border-b py-2">{{ $width * 25.4 }} mm</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['8'] }}</td>
                                    <td class="border-b py-2">{{ $width * 2.54 }} cm</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['8'] }}</td>
                                    <td class="border-b py-2">{{ $width / 12 }} ft</td>
                                </tr>
                            </table>
                            <table class="w-full mt-3">
                                <tr>
                                    <td width="60%" class="border-b py-2">{{ $lang['9'] }}</td>
                                    <td class="border-b py-2">{{ $lenght * 25.4 }} mm</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['9'] }}</td>
                                    <td class="border-b py-2">{{ $lenght * 2.54 }} cm</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['9'] }}</td>
                                    <td class="border-b py-2">{{ round($lenght / 12 , 8) }} ft</td>
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