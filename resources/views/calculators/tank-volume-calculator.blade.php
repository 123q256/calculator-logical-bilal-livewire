<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

            <div class="col-lg-6">
                <div class="space-y-2 ">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="operations" id="operations" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang[2],$lang[3],$lang[4],$lang[5],$lang[6],$lang[7],$lang[8],$lang[9],$lang[10],$lang[11],$lang[12]." (".$lang[13].")",$lang[14]];
                            $val = ['3','4','5','6','7','8','9','12','13','14','15','16'];
                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'3');
                        @endphp
                    </select>
                </div>
                 
                    @if($device == 'mobile')
                    <div class="text-center">
                        <img src="{{asset('images/tank/tank_first.png')}}" alt="Tank First" class="max-width" id="im" width="250px" height="250px">
                    </div>
                    @endif


                    <div class="space-y-2 mt-3" id="1">
                        <label for="first" class="font-s-14 text-blue" id="lb_1">
                            {{ $lang['19'] }} (l)
                        :</label>
                        <div class="relative w-full mt-3 ">
                            <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'m' }} ▾</label>
                            <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'m' }}" id="units1" class="hidden">
                            <div id="units1_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","mm"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', '{{$name}}')">{{$name}}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
    
                     <div class="space-y-2 second {{ isset($_POST['operations']) && $_POST['operations'] === '16' ? 'hidden' : 'd-block' }}" id="2">
                        <label for="second" class="font-s-14 text-blue" id="lb_2">
                            {{ $lang['20'] }} (d)                            
                        :</label>
                        <div class="relative w-full mt-3">
                            <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'m' }} ▾</label>
                            <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'m' }}" id="units2" class="hidden">
                            <div id="units2_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","mm"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', '{{$name}}')">{{$name}}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="space-y-2 third {{ isset($_POST['operations']) && ($_POST['operations'] === '3' ||  $_POST['operations'] === '4' ||  $_POST['operations'] === '9' ||  $_POST['operations'] === '16'  ) ? 'hidden' : 'd-block' }}" id="3">
                        <label for="third" class="font-s-14 text-blue" id="lb_3">
                            {{ $lang['19'] }} (l)
                        :</label>
                        <div class="relative w-full mt-3">
                            <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'mm' }} ▾</label>
                            <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'mm' }}" id="units3" class="hidden">
                            <div id="units3_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","mm"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', '{{$name}}')">{{$name}}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="space-y-2 fill mt-3 " id="5">
                        <label for="fill" class="font-s-14 text-blue" id="lb_5">{{$lang[29]}} ({{$lang[30]}}):</label>
                        <div class="relative w-full ">
                            <input type="number" name="fill" id="fill" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fill'])?$_POST['fill']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="fill_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fill_units_dropdown')">{{ isset($_POST['fill_units'])?$_POST['fill_units']:'ft' }} ▾</label>
                            <input type="text" name="fill_units" value="{{ isset($_POST['fill_units'])?$_POST['fill_units']:'ft' }}" id="fill_units" class="hidden">
                            <div id="fill_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","mm"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fill_units', '{{$name}}')">{{$name}}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                    
            </div>
            <div class="col-lg-6 mt-3">
                @if($device == 'desktop')
                <div class="mt-3 flex justify-center">
                    <img src="{{asset('images/tank/Horizantal-cylinder.webp')}}" alt="Tank First" class="max-width" id="im" width="250px" height="250px">
                </div>
                
                @endif
                <div class="space-y-2 four {{ isset($_POST['operations']) &&( $_POST['operations'] === '13' ||  $_POST['operations'] === '14') ? 'd-block' : 'hidden' }}" id="4">
                    <label for="four" class="font-s-14 text-blue" id="lb_4">{{ $lang['24'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'m' }} ▾</label>
                        <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'m' }}" id="units4" class="hidden">
                        <div id="units4_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","mm"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', '{{$name}}')">{{$name}}</p>
                            @endforeach
                        </div>
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
                <div class="rounded-lg   items-center justify-center">
                    <div class="w-full0 mt-3">
                        <div class="w-full my-2">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{$lang[15]}} in³:</strong></td>
                                        <td class="border-b py-2">{{number_format($detail['v_tank'], 2) }} in³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15]}} ft³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_feet'], 2) }} ft³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[16]}} :</td>
                                        <td class="border-b py-2">{{number_format($detail['v_liter'], 2) }} liters</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">US  {{$lang[17]}} :</td>
                                        <td class="border-b py-2">{{number_format($detail['us_gallons'], 2) }} </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15]}} m³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_meter'], 2) }} m³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15]}} yd³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_yard'], 2) }} yd³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15]}} cm³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_cm'], 2) }} cm³</td>
                                    </tr>
                                </table>
                                @if(!empty($detail['v_fill']))
                                    <table class="w-100 mt-2">
                                        <tr>
                                            <td width="50%" class="border-b py-2"><strong>{{$lang[18]}} :</strong></td>
                                            <td class="border-b py-2">{{number_format($detail['v_fill'], 2) }} in³ (<span class="font-s-18">{{round($detail['per_ans'])."%"." "."FULL"}}</span>)</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15]}} ft³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_feet_fill'], 2) }} ft³</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[16]}} :</td>
                                            <td class="border-b py-2">{{number_format($detail['v_liter_fill'], 2) }} liters</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">US  {{$lang[17]}} :</td>
                                            <td class="border-b py-2">{{number_format($detail['us_gallons_fill'], 2) }} </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15]}} m³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_meter_fill'], 2) }} m³</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15]}} yd³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_yard_fill'], 2) }} yd³</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15]}} cm³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_cm_fill'], 2) }} cm³</td>
                                        </tr>
                                    </table>
                                @endif
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
         var cal = document.getElementById('operations').value
            if (cal === '3') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{$lang[19]}} (l)");
                document.getElementById('lb_1').textContent = "{{$lang[19]}} (l):";
                document.getElementById('second').setAttribute("placeholder", "{{$lang[20]}} (d)");
                document.getElementById('lb_2').textContent = "{{$lang[20]}} (d):";
                document.getElementById('im').setAttribute('src', "{{asset('images/tank/Horizantal-cylinder.webp')}}");
            }
        @if(isset($detail) || isset($error))
            var cal = document.getElementById('operations').value;
            var selectedOption = document.getElementById('operations').options[document.getElementById('operations').selectedIndex];
            var op_name = selectedOption.text;
            var baseURL = "{{ asset('images/tank/') }}";
            if (cal === '3') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{$lang[19]}} (l)");
                document.getElementById('lb_1').textContent = "{{$lang[19]}} (l):";
                document.getElementById('second').setAttribute("placeholder", "{{$lang[20]}} (d)");
                document.getElementById('lb_2').textContent = "{{$lang[20]}} (d):";
                document.getElementById('im').setAttribute('src', "{{asset('images/tank/Horizantal-cylinder.webp')}}");
            }else if (cal === '4') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }else if (cal === '5') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '6') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "Height (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }else if (cal === '7') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '8') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[24] }} a");
                document.getElementById('lb_1').textContent = "{{ $lang[24] }} (a):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }else if (cal === '9') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[24] }} a");
                document.getElementById('lb_1').textContent = "{{ $lang[24] }} (a):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '12') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
            else if (cal === '13' || cal === '14') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'block';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[25] }}");
                document.getElementById('lb_1').textContent = "{{$lang[25]}}:";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[26] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[26] }}:";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[27] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[27] }}:";
                document.getElementById('four').setAttribute("placeholder", "{{ $lang[28] }}");
                document.getElementById('lb_4').textContent = "{{ isset($_POST['four'])?$_POST['four']:  $lang[28]  }}:";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
            else if (cal === '14'){
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
            else if (cal === '15') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[25] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[25] }}:";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[26] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[26] }}:";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[28] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[28] }}:";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '16' ) {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'none';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
        @endif
        
        document.getElementById('operations').addEventListener('change', function() {
            var cal = this.value;
            var selectedOption = this.options[this.selectedIndex];
            var op_name = selectedOption.text;
            var baseURL = "{{ asset('images/tank/') }}";
            if (cal === '3') {
                console.log(op_name );
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{$lang[19]}} (l)");
                document.getElementById('lb_1').textContent = "{{$lang[19]}} (l):";
                document.getElementById('second').setAttribute("placeholder", "{{$lang[20]}} (d)");
                document.getElementById('lb_2').textContent = "{{$lang[20]}} (d):";
                document.getElementById('im').setAttribute('src', "{{asset('images/tank/Horizantal-cylinder.webp')}}");
            }else if (cal === '4') {
                console.log(op_name );
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }else if (cal === '5') {
                console.log(op_name );
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '6') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "Height (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }else if (cal === '7') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '8') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[24] }} a");
                document.getElementById('lb_1').textContent = "{{ $lang[24] }} (a):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }else if (cal === '9') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[24] }} a");
                document.getElementById('lb_1').textContent = "{{ $lang[24] }} (a):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '12') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[21] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[21] }} (h):";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[22] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[22] }} (w):";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[19] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[19] }} (l):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
            else if (cal === '13' || cal === '14') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'block';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[25] }}");
                document.getElementById('lb_1').textContent = "{{$lang[25]}}:";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[26] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[26] }}:";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[27] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[27] }}:";
                document.getElementById('four').setAttribute("placeholder", "{{ $lang[28] }}");
                document.getElementById('lb_4').textContent = "{{ isset($_POST['four'])?$_POST['four']:  $lang[28]  }}:";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
            else if (cal === '14'){
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
            else if (cal === '15') {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'block';
                document.getElementById('3').style.display = 'block';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[25] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[25] }}:";
                document.getElementById('second').setAttribute("placeholder", "{{ $lang[26] }}");
                document.getElementById('lb_2').textContent = "{{ $lang[26] }}:";
                document.getElementById('third').setAttribute("placeholder", "{{ $lang[28] }}");
                document.getElementById('lb_3').textContent = "{{ $lang[28] }}:";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            } else if (cal === '16' ) {
                document.getElementById('1').style.display = 'block';
                document.getElementById('2').style.display = 'none';
                document.getElementById('3').style.display = 'none';
                document.getElementById('4').style.display = 'none';
                document.getElementById('first').setAttribute("placeholder", "{{ $lang[20] }}");
                document.getElementById('lb_1').textContent = "{{ $lang[20] }} (d):";
                document.getElementById('im').setAttribute('src', baseURL + "/" + op_name + '.webp');
            }
        });
    </script>
@endpush

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>