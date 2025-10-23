@if(app()->getLocale() == "ru")
    @include('calculators.square-meter-calculator-ru')
@else
    <form class="row" action="{{ url()->current() }}/" method="POST">
        @csrf
     
        
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                <div class="grid grid-cols-12  gap-4">
                        <div class=" col-span-6 row">

                            <div class="space-y-2  ">
                                <label for="volume_select" class="label">{{ $lang['12'] }}</label>
                                <div class="w-full pt-1">
                                    <select name="volume_select" id="volume_select" class="input">
                                        @php
                                            function optionsList($arr1,$arr2,$unit){
                                            foreach($arr1 as $index => $name){
                                        @endphp
                                            <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                                {{ $arr2[$index] }}
                                            </option>
                                        @php
                                            }}
                                            $name = [$lang['13'], $lang['14'], $lang['15'], $lang['16']];
                                            $val = [1, 2, 3, 4];
                                            optionsList($val,$name,isset($_POST['volume_select'])?$_POST['volume_select']: 1);
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-12  gap-4 mt-3">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6  sidea">
                                    <label for="length" class="label " id="sidea">{{ $lang['1'] }}:</label>
                                    <div class="relative w-full ">
                                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="l_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('l_units_dropdown')">{{ isset($_POST['l_units'])?$_POST['l_units']:'cm' }} ▾</label>
                                        <input type="text" name="l_units" value="{{ isset($_POST['l_units'])?$_POST['l_units']:'cm' }}" id="l_units" class="hidden">
                                        <div id="l_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="l_units">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'cm')">centimeters (cm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'mm')">milimeters (mm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'm')">meters (m)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'in')">inches (in)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'ft')">feet (ft)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'yd')">yards (yd)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6  sideb">
                                    <label for="width" class="label cat" id="sideb">{{ $lang['2'] }}:</label>
                                    <div class="relative w-full ">
                                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="w_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_units_dropdown')">{{ isset($_POST['w_units'])?$_POST['w_units']:'cm' }} ▾</label>
                                        <input type="text" name="w_units" value="{{ isset($_POST['w_units'])?$_POST['w_units']:'cm' }}" id="w_units" class="hidden">
                                        <div id="w_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="w_units">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'cm')">centimeters (cm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'mm')">milimeters (mm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'm')">meters (m)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'in')">inches (in)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'ft')">feet (ft)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'yd')">yards (yd)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6  sidec hidden">
                                    <label for="side" class="label cat" id="sidec">{{ $lang['17'] }} c:</label>
                                    <div class="relative w-full ">
                                        <input type="number" name="side" id="side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side'])?$_POST['side']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="s_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('s_units_dropdown')">{{ isset($_POST['s_units'])?$_POST['s_units']:'cm' }} ▾</label>
                                        <input type="text" name="s_units" value="{{ isset($_POST['s_units'])?$_POST['s_units']:'cm' }}" id="s_units" class="hidden">
                                        <div id="s_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="s_units">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'cm')">centimeters (cm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'mm')">milimeters (mm)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'm')">meters (m)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'in')">inches (in)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'ft')">feet (ft)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'yd')">yards (yd)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6  quantity">
                                    <label for="quantity" class="label">{{ $lang['19'] }}:</label>
                                    <div class="w-full  position-relative">
                                        <input type="number" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset($_POST['quantity'])?$_POST['quantity']:'1' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 mt-3 ">
                                <label for="price" class="label">{{ $lang['3'] }} ({{ $lang['4'] }}):</label>
                                <div class="w-100  relative">
                                    <input type="number" name="price" id="price" class="input" aria-label="input"  value="{{ isset($_POST['price'])?$_POST['price']:'' }}" />
                                    <span class="text-blue input_unit">{{$currancy}}/m</span>
                                </div>
                            </div>
                        </div>
                        <div class=" col-span-6  ps-lg-4 flex items-center">
                            <div class="col-11 px-2 mx-auto">
                                <img src="{{asset("images/meter1.png")}}" alt="Square Meter" id="imgchange" class="max-width " >
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
                        <div class="row mt-2">
                            <div class="w-full">
                                @if(isset($detail['res']))
                                    @php
                                        $res = round($detail['res'],2);
                                    @endphp
                                @endif
                                <div class="w-full md:w-[50%] lg:w-[50%] overflow-auto font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{$lang[20]}} {{$lang[5]}} :</strong></td>
                                            <td class="border-b py-2">{{$res}} m<sup>2</sup></span></td>
                                        </tr>
                                        @if(isset($detail['cost']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang[3]}} :</strong></td>
                                                <td class="border-b py-2">{{$currancy}} {{round($detail['cost'],2)}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <table class="w-full">
                                        <tr>
                                        <td width="60%" class="border-b py-2">{{$lang[20]}} {{$lang['11']}} {{$lang['6']}} :</td>
                                        <td class="border-b py-2">{{$res * 1000000}} mm<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2">{{$lang[20]}} {{ $lang['11'] }} {{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{$res * 10000}} cm<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2">{{$lang[20]}} {{ $lang['11'] }} {{$lang['8']}} :</td>
                                        <td class="border-b py-2">{{$res * 1550 }} in<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2">{{$lang[20]}} {{ $lang['11'] }} {{$lang['9']}} :</td>
                                        <td class="border-b py-2">{{$res * 10.764}} ft<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                        <td>{{$lang[20]}} {{ $lang['11'] }} {{$lang['10']}} :</td>
                                        <td>{{$res * 1.196 }} yd<sup>2</sup></td>
                                        </tr>
                                    </table>
                                </div>
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
            var sidea = document.querySelector('.sidea');
            var sideb = document.querySelector('.sideb');
            var sidec = document.querySelector('.sidec');
            var isidea = document.getElementById('sidea');
            var isideb = document.getElementById('sideb');
            var isidec = document.getElementById('sidec');
            var quantity = document.querySelector('.quantity');
            var imgchange = document.getElementById('imgchange');
            document.getElementById('volume_select').addEventListener('change',function(){
                var volume_select = this.value;
                if(volume_select == 1){
                    sidea.style.display = 'block';
                    isidea.innerHTML = "{{$lang['1']}}:";
                    sideb.style.display = 'block';
                    isideb.innerHTML = "{{$lang['2']}}:";
                    sidec.style.display = 'none';
                    isidec.innerHTML = "{{$lang['17']}} c:"
                    imgchange.setAttribute("src", "{{asset('images/meter1.png')}}");

                }else if(volume_select == 2){
                    sidea.style.display = 'none';
                    isidea.innerHTML = "{{$lang['1']}}:";
                    sideb.style.display = 'block';
                    isideb.innerHTML = "{{$lang['2']}}:";
                    sidec.style.display = 'none';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter2.png')}}");

                }else if(volume_select == 3){
                    sidea.style.display = 'block';
                    isidea.innerHTML = "{{$lang['18']}}:";
                    sideb.style.display = 'none';
                    isideb.innerHTML = "{{$lang['2']}}:";
                    sidec.style.display = 'none';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter3.png')}}");
                }else{
                    sidea.style.display = 'block';
                    isidea.innerHTML = "{{$lang['17']}} a:";
                    sideb.style.display = 'block';
                    isideb.innerHTML = "{{$lang['17']}} b:";
                    sidec.style.display = 'block';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter4.png')}}");
                }
            });
            @if(isset($detail) || isset($error))
                var volume_select = document.getElementById('volume_select').value;
                if(volume_select == 1){
                    sidea.style.display = 'block';
                    imgchange.style.display = 'block';
                    isidea.innerHTML = "{{$lang['1']}}:";
                    sideb.style.display = 'block';
                    isideb.innerHTML = "{{$lang['2']}}:";
                    sidec.style.display = 'none';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter1.png')}}");

                }else if(volume_select == 2){
                    sidea.style.display = 'none';
                    isidea.innerHTML = "{{$lang['1']}}:";
                    sideb.style.display = 'block';
                    isideb.innerHTML = "{{$lang['2']}}:";
                    sidec.style.display = 'none';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter2.png')}}");

                }else if(volume_select == 3){
                    sidea.style.display = 'block';
                    isidea.innerHTML = "{{$lang['18']}}:";
                    sideb.style.display = 'none';
                    isideb.innerHTML = "{{$lang['2']}}:";
                    sidec.style.display = 'none';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter3.png')}}");

                }else{
                    sidea.style.display = 'block';
                    isidea.innerHTML = "{{$lang['17']}} a:";
                    sideb.style.display = 'block';
                    isideb.innerHTML = "{{$lang['17']}} b:";
                    sidec.style.display = 'block';
                    isidec.innerHTML = "{{$lang['17']}} c:";
                    imgchange.setAttribute("src", "{{asset('images/meter4.png')}}");

                }
            @endif
        </script>
    @endpush
@endif
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>