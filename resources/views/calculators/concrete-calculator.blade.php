@php
    $price_unit=request()->price_unit;
    $price=request()->price;
@endphp
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
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select name="operations" id="operations" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9']];
                                        $val = ['3','4','5','6','7','8','9','10'];
                                        optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'3');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 first_v">
                            <label for="first" class="font-s-14 text-blue first_text">
                                @if(isset($_POST['operations']) && ($_POST['operations'] === '3' ||  $_POST['operations'] === '4' ||  $_POST['operations'] === '6'))
                                    {{ $lang['10'] }}
                                @elseif(isset($_POST['operations']) && ($_POST['operations'] === '5' ||  $_POST['operations'] === '7' ||  $_POST['operations'] === '8'))
                                    {{ $lang['28'] }}
                                @elseif(isset($_POST['operations']) && $_POST['operations'] === '9')
                                    {{$lang['29']}}
                                @else
                                    {{ $lang['32'] }}
                                @endif
                            :</label>
                            <div class="relative w-full ">
                                <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'in' }} ▾</label>
                                <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'in' }}" id="units1" class="hidden">
                                <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units1', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 second">
                            <label for="second" class="font-s-14 text-blue second_text">
                                @if(isset($_POST['operations']) && ($_POST['operations'] === '3' ||  $_POST['operations'] === '5' ||  $_POST['operations'] === '6' || $_POST['operations'] === '7' ))
                                    {{ $lang['11'] }}
                                @elseif(isset($_POST['operations']) && ($_POST['operations'] === '4' || $_POST['operations'] === '8'))
                                    {{ $lang['27'] }}
                                @elseif(isset($_POST['operations']) && $_POST['operations'] === '9')
                                    {{$lang['30']}}
                                @else
                                    {{ $lang['33'] }}
                                @endif
                            :</label>
                            <div class="relative w-full ">
                                <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'in' }} ▾</label>
                                <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'in' }}" id="units2" class="hidden">
                                <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units2', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                       
                         <div class="col-span-12 third {{ isset($_POST['operations']) && ($_POST['operations'] === '4' || $_POST['operations'] === '8') ?'d-none':'d-block' }}">
                            <label for="third" class="font-s-14 text-blue third_text">
                                @if(isset($_POST['operations']) && ($_POST['operations'] === '3' ||  $_POST['operations'] === '5' ||  $_POST['operations'] === '6' || $_POST['operations'] === '7' ))
                                    {{ $lang['12'] }}
                                @elseif(isset($_POST['operations']) && $_POST['operations'] === '9')
                                    {{$lang['31']}}
                                @else
                                    {{ $lang['34'] }}
                                @endif
                            :</label>
                            <div class="relative w-full ">
                                <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'m' }} ▾</label>
                                <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'m' }}" id="units3" class="hidden">
                                <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units3', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>

                         <div class="col-span-12 four {{ isset($_POST['operations']) && ($_POST['operations'] === '9'||$_POST['operations'] === '10') ?'d-block':'d-none' }}">
                            <label for="four" class="font-s-14 text-blue four_text">
                                @if(isset($_POST['operations']) && $_POST['operations'] === '9')
                                    {{$lang['12']}}
                                @else
                                    {{ $lang['13'] }}
                                @endif
                            :</label>
                            <div class="relative w-full ">
                                <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'ft' }} ▾</label>
                                <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'ft' }}" id="units4" class="hidden">
                                <div id="units4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units4">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units4', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                        

                         <div class="col-span-12 price ">
                            <label for="price" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft³' }} ▾</label>
                                <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft³' }}" id="price_unit" class="hidden">
                                <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', 'ft³')"> ft³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', 'yd³')"> yd³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', 'm³')"> m³</p>
                                </div>
                            </div>
                         </div>
                   </div>
                </div>
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 quantity">
                            <label for="quantity" class="font-s-14 text-blue">{{ $lang['16'] }}:</label>
                            <div class="w-100 py-2 position-relative"> 
                                <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset($_POST['quantity'])?$_POST['quantity']:'1' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 five {{ isset($_POST['operations']) && $_POST['operations'] === '10' ?'d-block':'d-none' }}">
                            <label for="five" class="font-s-14 text-blue five_text">
                                @if(isset($_POST['operations']) && $_POST['operations'] === '9')
                                    {{$lang['14']}}
                                @else
                                    {{ $lang['11'] }}
                                @endif
                            :</label>
                            <div class="relative w-full ">
                                <input type="number" name="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five'])?$_POST['five']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units5_dropdown')">{{ isset($_POST['units5'])?$_POST['units5']:'ft' }} ▾</label>
                                <input type="text" name="units5" value="{{ isset($_POST['units5'])?$_POST['units5']:'ft' }}" id="units5" class="hidden">
                                <div id="units5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units5">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units5', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                        <div class="col-span-12 fiveb {{ isset($_POST['operations']) && $_POST['operations'] === '9' ?'d-block':'d-none' }}">
                            <label for="fiveb" class="font-s-14 text-blue">{{ $lang['15'] }}:</label>
                            <div class="w-100 py-2 position-relative"> 
                                <input type="number" step="any" name="fiveb" id="fiveb" class="input" aria-label="input"  value="{{ isset($_POST['fiveb'])?$_POST['fiveb']:'15' }}" />
                            </div>
                        </div>
                        <div class="col-span-12">
                        <img src="{{asset('images/Square Slab.webp')}}" alt="ShapeImage" class="max-width my-lg-2 imgset" width="200px" height="180px">
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
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-[20px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['18']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['cubic_feet']}} ft³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['19']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['cubic_yard']}} yd³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['20']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['cubic_meter']}} m³</td>
                                    </tr>
                                    @if ($price_unit === '1' && !empty($price))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['21']}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy.' '.$detail['ft_price']}}</td>
                                        </tr>
                                    @endif
                                    @if ($price_unit === '2' && !empty($price))
                                        <tr>
                                          <td class="border-b py-2"><strong>{{$lang['21']}} :</strong></td>
                                          <td class="border-b py-2">{{$currancy.' '.$detail['yd_price']}}</td>
                                        </tr>
                                    @endif
                                    @if ($price_unit === '3' && !empty($price))
                                        <tr>
                                          <td class="border-b py-2"><strong>{{$lang['21']}} :</strong></td>
                                          <td class="border-b py-2">{{$currancy.' '.$detail['m_price']}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <p class="mb-2 mt-3">{{$lang['22']}} 2,130 kg/m3 {{$lang['23']}} 133 lbs/ft3</p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-[20px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2">{{$lang['24']}} :</td>
                                        <td class="border-b py-2">{{$detail['lb']." "."lbs"." "."or"." ".$detail['kg']." "."kgs"}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['25']. " 40-lb " . $lang['26']}} :</td>
                                        <td class="border-b py-2">{{$detail['lb_40']}} bags</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['25']. " 60-lb " .$lang['26']}} :</td>
                                        <td class="border-b py-2">{{$detail['lb_60']}} bags</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['25']. " 80-lb " .$lang['26']}} :</td>
                                        <td class="border-b py-2">{{$detail['lb_80']}} bags</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['25']. " 40-kg " .$lang['26']}} :</td>
                                        <td class="border-b py-2">{{$detail['kg_40']}} bags</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['25']. " 60-kg " .$lang['26']}} :</td>
                                        <td class="border-b py-2">{{$detail['kg_60']}} bags</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['25']. " 80-kg " .$lang['26']}} :</td>
                                        <td class="border-b py-2">{{$detail['kg_80']}} bags</td>
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
    <script>
        var first = document.querySelector('.first_v');
        var first_t = document.querySelector('.first_text');
        var second = document.querySelector('.second');
        var second_t = document.querySelector('.second_text');
        var third= document.querySelector('.third');
        var third_t= document.querySelector('.third_text');
        var four = document.querySelector('.four');
        var four_t = document.querySelector('.four_text');
        var five = document.querySelector('.five');
        var five_t = document.querySelector('.five_text');
        var fiveb= document.querySelector('.fiveb');
        var price= document.querySelector('.price');
        var quantity= document.querySelector('.quantity');
        var imgset= document.querySelectorAll('.imgset');

        if (document.getElementById('operations').value === "3"){
                first_t.innerHTML = "{{$lang['10']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src',"{{asset('images/Square Slab.webp')}}");
                });
            }

        document.getElementById('operations').addEventListener('change',function(){
            var value = this.value;
            var selectedOption = this.options[this.selectedIndex];
            var op_name = selectedOption.text;
            var baseURL = "{{ asset('images/') }}";
            if (value === "3"){
                first_t.innerHTML = "{{$lang['10']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            } else if (value === "4") {
                second_t.innerHTML = "{{$lang['27']}}:";
                third.style.display = "none";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "5") {
                first_t.innerHTML = "{{$lang['28']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "6") {
                first_t.innerHTML = "{{$lang['10']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "7") {
                first_t.innerHTML = "{{$lang['28']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "8") {
                first_t.innerHTML = "{{$lang['28']}}:";
                second_t.innerHTML = "{{$lang['27']}}:";
                third.style.display = "none";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "9") {
                first_t.innerHTML = "{{$lang['29']}}:";
                second_t.innerHTML = "{{$lang['30']}}:";
                third_t.innerHTML = "{{$lang['31']}}:";
                four_t.innerHTML = "{{$lang['12']}}:";
                five_t.innerHTML = "{{$lang['14']}}:";
                third.style.display = "block";
                four.style.display = "block";
                five.style.display = "none";
                fiveb.style.display = "block";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "10") {
                first_t.innerHTML = "{{$lang['32']}}:";
                second_t.innerHTML = "{{$lang['33']}}:";
                third_t.innerHTML = "{{$lang['34']}}:";
                four_t.innerHTML = "{{$lang['13']}}:";
                five_t.innerHTML = "{{$lang['11']}}:";
                third.style.display = "block";
                four.style.display = "block";
                five.style.display = "block";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }
        });

        @if(isset($detail) || isset($error))
            var value = document.getElementById('operations').value;
            var selectedOption = document.getElementById('operations').options[document.getElementById('operations').selectedIndex];
            var op_name = selectedOption.text;
            var baseURL = "{{ asset('images/') }}";
            if (value === "3"){
                first_t.innerHTML = "{{$lang['10']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            } else if (value === "4") {
                second_t.innerHTML = "{{$lang['27']}}:";
                third.style.display = "none";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "5") {
                first_t.innerHTML = "{{$lang['28']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "6") {
                first_t.innerHTML = "{{$lang['10']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "7") {
                first_t.innerHTML = "{{$lang['28']}}:";
                second_t.innerHTML = "{{$lang['11']}}:";
                third_t.innerHTML = "{{$lang['12']}}:";
                third.style.display = "block";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "8") {
                first_t.innerHTML = "{{$lang['28']}}:";
                second_t.innerHTML = "{{$lang['27']}}:";
                third.style.display = "none";
                four.style.display = "none";
                five.style.display = "none";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "9") {
                first_t.innerHTML = "{{$lang['29']}}:";
                second_t.innerHTML = "{{$lang['30']}}:";
                third_t.innerHTML = "{{$lang['31']}}:";
                four_t.innerHTML = "{{$lang['12']}}:";
                five_t.innerHTML = "{{$lang['14']}}:";
                third.style.display = "block";
                four.style.display = "block";
                five.style.display = "none";
                fiveb.style.display = "block";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }else if (value === "10") {
                first_t.innerHTML = "{{$lang['32']}}:";
                second_t.innerHTML = "{{$lang['33']}}:";
                third_t.innerHTML = "{{$lang['34']}}:";
                four_t.innerHTML = "{{$lang['13']}}:";
                five_t.innerHTML = "{{$lang['11']}}:";
                third.style.display = "block";
                four.style.display = "block";
                five.style.display = "block";
                fiveb.style.display = "none";
                imgset.forEach(element => {
                    element.setAttribute('src', baseURL + "/" + op_name + '.webp');
                });
            }
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>