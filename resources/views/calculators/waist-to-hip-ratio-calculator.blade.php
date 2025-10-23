<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="font-s-14 text-blue">{!! $lang['gen'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="gender" id="gender" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['male'],$lang['female']];
                                $val = ["male","female"];
                                optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="w" class="font-s-14 text-blue">{{ $lang['w'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="w" id="w" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w']) ? $_POST['w'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'in' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'in' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">centimeters (cm)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="h" class="font-s-14 text-blue">{{ $lang['h'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="h" id="h" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h']) ? $_POST['h'] : '40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'in' }} ▾</label>
                        <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'in' }}" id="unit1" class="hidden">
                        <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
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
                        <p class="w-full text-[20px] mt-2"><strong><?=$lang['ans']?></strong></p>
                        <p class="w-full flex items-center mt-2">
                            <img src="{{ asset('images/waist.png') }}" width="55" height="55" alt="waist to hip ratio calculator">
                            @if(isset($detail['ans']))
                                <strong class="text-green-700 text-[32px] ms-3">{{ $detail['ans'] }}</strong>
                            @else
                                <strong class="text-green-700 text-[32px] ms-3">00.0</strong>
                            @endif
                        </p>
                        @if($detail['request']->gender=='male')
                        <div class="lg:w-[70%] md:w-[70%] w-full overflow-auto grid-cols-1">
                            <table class="w-full mt-3" >
                                <tr>
                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['male'] }}</th>
                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['hr'] }}</th>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">0.95 {{ $lang['ol'] }}</td>
                                    <td class="border-b py-2">{{ $lang['lhr'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">0.96 to 1.0</td>
                                    <td class="border-b py-2">{{ $lang['mr'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">1.0 {{ $lang['oh'] }}</td>
                                    <td class="py-2">{{ $lang['hhr'] }}</td>
                                </tr>
                            </table>
                        </div>
                            <p class="col-12 px-1 mt-1"><strong>0.9 {{ $lang['men'] }}</strong></p>
                        @elseif($detail['request']->gender=='female')
                        <div class="lg:w-[70%] md:w-[70%] w-full overflow-auto grid-cols-1">
                            <table class="w-full mt-3" >
                                <tr>
                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['female'] }}</th>
                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['hr'] }}</th>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">0.80 {{ $lang['ol'] }}</td>
                                    <td class="border-b py-2">{{ $lang['lhr'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">0.81 to 0.84</td>
                                    <td class="border-b py-2">{{ $lang['mr'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">0.85 {{ $lang['oh'] }}</td>
                                    <td class="py-2">{{ $lang['hhr'] }}</td>
                                </tr>
                            </table>
                        </div>

                            <p class="col-12 px-1 mt-1"><strong>0.85 {{ $lang['women'] }}</strong></p>
                        @endif
                        <p class="text-start text-[20px] mt-3"><strong class="text-blue-600">{{ $lang['whc'] }}</strong></p>
                        <div class="lg:w-[70%] md:w-[70%] w-full overflow-auto grid-cols-1 ">
                        <table class=" w-full mt-2 " cellspacing="0" style="border: 1px solid #c1b8b899;">
                            <tbody>
                                <tr class="bg-[#2845F5] text-white">
                                    <td class=" py-3 ps-3 radius-tl-20">{{ $lang['gen'] }}</td>
                                    <td class=" py-3">{{ $lang['health'] }}</td>
                                    <td class=" py-3">{{ $lang['inc'] }}</td>
                                    <td class=" py-3 radius-tr-20">{{ $lang['hhr'] }}</td>
                                </tr>
                                @if($detail['request']->gender == 'female')
                                    <tr>
                                        <td class="py-3 ps-3">{{ $lang['female'] }}</td>							
                                        <td class="py-3">80 cm {{ $lang['orl'] }}</td>
                                        <td class="py-3">from 80 to 88 cm</td>
                                        <td class="py-3">88 cm {{ $lang['oo'] }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-3 ps-3">{{ $lang['male'] }}</td>
                                        <td class="py-3">90 cm {{ $lang['orl'] }}</td>							
                                        <td class="py-3">from 90 to 102 cm</td>
                                        <td class="py-3">102 cm {{ $lang['oo'] }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>