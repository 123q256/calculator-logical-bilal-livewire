<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-6">
                    <label for="weist" class="label" id="cc_hp1">{{$lang['1']}}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weist" id="weist" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weist']) ? $_POST['weist'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="measure_in_weiat" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('measure_in_weiat_dropdown')">{{ isset($_POST['measure_in_weiat'])?$_POST['measure_in_weiat']:'in' }} ▾</label>
                        <input type="text" name="measure_in_weiat" value="{{ isset($_POST['measure_in_weiat'])?$_POST['measure_in_weiat']:'in' }}" id="measure_in_weiat" class="hidden">
                        <div id="measure_in_weiat_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="measure_in_weiat">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('measure_in_weiat', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('measure_in_weiat', 'dm')">decimeter (dm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('measure_in_weiat', 'in')">inches (in)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="length" class="label">{{$lang['3']}}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '28' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="measure_in_length" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('measure_in_length_dropdown')">{{ isset($_POST['measure_in_length'])?$_POST['measure_in_length']:'in' }} ▾</label>
                        <input type="text" name="measure_in_length" value="{{ isset($_POST['measure_in_length'])?$_POST['measure_in_length']:'in' }}" id="measure_in_length" class="hidden">
                        <div id="measure_in_length_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="measure_in_length">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('measure_in_length', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('measure_in_length', 'dm')">decimeter (dm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('measure_in_length', 'in')">inches (in)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="measure" class="label">{{$lang['4']}}:</label>
                    <div class="w-100 py-2"> 
                        <select class="input" name="measure" id="measure" >
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['5'],$lang['6']];
                                $val = ["myself","pair"];
                                optionsList($val,$name,isset(request()->measure)?request()->measure:'myself');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="gender" class="label">{{$lang['7']}}:</label>
                    <div class="w-100 py-2"> 
                        <select class="input" name="gender" id="gender" >
                            @php
                                $name = [$lang['8'],$lang['9']];
                                $val = ["male","female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'male');
                            @endphp
                        </select>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    @if(!empty($detail['result_us']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>US {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_us']}}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($detail['result_india']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>India {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_india']}}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($detail['result_uk']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>United Kindom {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_uk']}}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($detail['result_eu']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>European {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_eu']}}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($detail['result_it']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>Italian {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_it']}}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($detail['result_ru']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>Russian {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_ru']}}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($detail['result_ja']))
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>Japanese {{$lang['10']}}:</strong></td>
                                            <td class="border-b py-2">{{$detail['result_ja']}}</td>
                                        </tr>
                                    @endif
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
        @if(isset($detail))
            var solve_val = document.getElementById('measure');
            var cc_hp1 = document.getElementById("cc_hp1");
            if (solve_val === "myself") {
                cc_hp1.innerHTML = "{{$lang[1]}}:";
            }else {
                cc_hp1.innerHTML = "{{$lang[2]}}:";
            }
        @endif
        document.getElementById('measure').addEventListener('change',function(){
            var solve_val = this.value;
            var cc_hp1 = document.getElementById("cc_hp1");
            if (solve_val === "myself") {
                cc_hp1.innerHTML = "{{$lang[1]}}:";
            }else {
                cc_hp1.innerHTML = "{{$lang[2]}}:";
            }
        });
    </script>
@endpush