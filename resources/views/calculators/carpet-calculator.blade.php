<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">

                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 mt-0">
                            <label for="shape" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                            <div class="w-100 py-2"> 
                                <select name="shape" id="shape" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {{ $arr2[$index] }}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang[2], $lang[3], $lang[4], $lang[5], $lang[6], $lang[7]];
                                            $val = [$lang[2], $lang[3], $lang[4], $lang[5], $lang[6], $lang[7]];
                                        optionsList($val,$name,isset(request()->shape)?request()->shape: $lang[2] );
                                    @endphp
                                </select>
                            </div>
                        </div>

                        <div class="col-span-12 mt-0 length">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                                <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                                <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 width">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                                <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                                <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 hidden radius">
                            <label for="radius" class="font-s-14 text-blue">{{ $lang['11'] }} (r):</label>
                            <div class="relative w-full ">
                                <input type="number" name="radius" id="radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius'])?$_POST['radius']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_unit_dropdown')">{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'cm' }} ▾</label>
                                <input type="text" name="radius_unit" value="{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'cm' }}" id="radius_unit" class="hidden">
                                <div id="radius_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 hidden axis_a">
                            <label for="axis_a" class="font-s-14 text-blue">{{ $lang['12'] }} (A):</label>
                            <div class="relative w-full ">
                                <input type="number" name="axis_a" id="axis_a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['axis_a'])?$_POST['axis_a']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="axis_a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('axis_a_unit_dropdown')">{{ isset($_POST['axis_a_unit'])?$_POST['axis_a_unit']:'cm' }} ▾</label>
                                <input type="text" name="axis_a_unit" value="{{ isset($_POST['axis_a_unit'])?$_POST['axis_a_unit']:'cm' }}" id="axis_a_unit" class="hidden">
                                <div id="axis_a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="axis_a_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('axis_a_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 hidden axis_b">
                            <label for="axis_b" class="font-s-14 text-blue">{{ $lang['12'] }} (B):</label>
                            <div class="relative w-full ">
                                <input type="number" name="axis_b" id="axis_b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['axis_b'])?$_POST['axis_b']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="axis_b_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('axis_b_unit_dropdown')">{{ isset($_POST['axis_b_unit'])?$_POST['axis_b_unit']:'cm' }} ▾</label>
                                <input type="text" name="axis_b_unit" value="{{ isset($_POST['axis_b_unit'])?$_POST['axis_b_unit']:'cm' }}" id="axis_b_unit" class="hidden">
                                <div id="axis_b_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="axis_b_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('axis_b_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 hidden side">
                            <label for="side" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="side" id="side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side'])?$_POST['side']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="side_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side_unit_dropdown')">{{ isset($_POST['side_unit'])?$_POST['side_unit']:'cm' }} ▾</label>
                                <input type="text" name="side_unit" value="{{ isset($_POST['side_unit'])?$_POST['side_unit']:'cm' }}" id="side_unit" class="hidden">
                                <div id="side_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('side_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 hidden sides">
                            <label for="sides" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="sides" id="sides" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sides'])?$_POST['sides']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="sides_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sides_unit_dropdown')">{{ isset($_POST['sides_unit'])?$_POST['sides_unit']:'m' }} ▾</label>
                                <input type="text" name="sides_unit" value="{{ isset($_POST['sides_unit'])?$_POST['sides_unit']:'m' }}" id="sides_unit" class="hidden">
                                <div id="sides_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sides_unit">
                                    @foreach (["cm", "dm", "m", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sides_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                      
                         <div class="col-span-12 mt-0 hidden carpet">
                            <label for="carpet" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="carpet" id="carpet" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['carpet'])?$_POST['carpet']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="carpet_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('carpet_unit_dropdown')">{{ isset($_POST['carpet_unit'])?$_POST['carpet_unit']:'m' }} ▾</label>
                                <input type="text" name="carpet_unit" value="{{ isset($_POST['carpet_unit'])?$_POST['carpet_unit']:'m' }}" id="carpet_unit" class="hidden">
                                <div id="carpet_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="carpet_unit">
                                    @foreach (["cm²", "dm²", "m²", "in²", "ft²", "yd²"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('carpet_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 mt-0 price">
                            <label for="price" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'m' }} ▾</label>
                                <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'m' }}" id="price_unit" class="hidden">
                                <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                                    @foreach ([$currancy." cm²", $currancy." dm²", $currancy." m²", $currancy." in²", $currancy." ft²", $currancy." yd²"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="col-span-6 flex items-center justify-center">
                    <p class="altimge hidden">{{$lang[15]}}</p>
                    <img src="{{asset('images/Rectangle.webp')}}" alt="Rectangle" class="max-width change_image" width="100%" height="150px">
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
                    @php
                        $price_unit = request()->price_unit;
                        $currancy = request()->currancy;
                        $price_unit = str_replace($currancy.' ', '', $price_unit);
                    @endphp
                    <div class="w-full my-2">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                            <table class="w-full">
                                <tr>
                                    <td width="70%" class="border-b py-2"><strong>Carpet Area :</strong></td>
                                    <td class="border-b py-2">{{ round($detail['answer'], 4) }} <span class="font-s-14">m²</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['16']}} :</strong></td>
                                    @if($price_unit === "m²")
                                        <td class="border-b py-2">{{ $currancy.' '.round($detail['sub_answer'], 4) }}</td>
                                    @elseif($price_unit === "cm²")
                                        <td class="border-b py-2">{{ $currancy.' '.round($detail['sub_answer'] * 10000, 4) }}</td>
                                    @elseif($price_unit === "dm²")
                                        <td class="border-b py-2">{{ $currancy.' '.round($detail['sub_answer'] * 100, 4) }}</td>
                                    @elseif($price_unit === "in²")
                                        <td class="border-b py-2">{{ $currancy.' '.round($detail['sub_answer'] * 1550, 4) }}</td>
                                    @elseif($price_unit === "ft²")
                                        <td class="border-b py-2">{{ $currancy.' '.round($detail['sub_answer'] * 10.764, 4) }}</td>
                                    @elseif($price_unit === "yd²")
                                        <td class="border-b py-2">{{ $currancy.' '.round($detail['sub_answer'] * 1.196, 4) }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="2" class="pt-3 pb-1">{{$lang[17]}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">cm² :</td>
                                    <td class="border-b py-2">{{round($detail['answer'] * 10000, 4)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">dm² :</td>
                                    <td class="border-b py-2">{{ round($detail['answer'] * 100, 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">in² :</td>
                                    <td class="border-b py-2">{{ round($detail['answer']  * 1550, 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">ft² :</td>
                                    <td class="border-b py-2">{{ round($detail['answer'] * 10.764, 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">yd² :</td>
                                    <td class="border-b py-2">{{ round($detail['answer'] * 1.196, 4) }}</td>
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
        var length = document.querySelector('.length');
        var width = document.querySelector('.width');
        var radius = document.querySelector('.radius');
        var carpet = document.querySelector('.carpet');
        var sides = document.querySelector('.sides');
        var side = document.querySelector('.side');
        var axis_a = document.querySelector('.axis_a');
        var axis_b = document.querySelector('.axis_b');
        var altimge = document.querySelector('.altimge');
        var change_image = document.querySelector('.change_image');
        @if(isset($detail))
            var shape = document.getElementById('shape').value;
            if(shape == '{{$lang[2]}}'){
                length.style.display = "block";
                change_image.style.display = "block";
                width.style.display = "block";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                altimge.style.display = "none";
                change_image.setAttribute("src","{{asset('images/Rectangle.webp')}}");
                change_image.style.display = "block";
            }else if(shape == '{{$lang[3]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "block";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                altimge.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/cr_Circle.webp')}}");
            }else if(shape == '{{$lang[4]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "block";
                axis_b.style.display = "block";
                altimge.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/ellipse.webp')}}");
            }else if(shape == '{{$lang[5]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "block";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                altimge.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/Pentagon.webp')}}");
            }else if(shape == '{{$lang[6]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "block";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                altimge.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/Hexagon.webp')}}");
            }else if(shape == '{{$lang[7]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "block";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                altimge.style.display = "block";
                change_image.style.display = "none";
            }
        @endif
        document.getElementById('shape').addEventListener('change',function(){
            var shape = this.value;
            if(shape == '{{$lang[2]}}'){
                length.style.display = "block";
                change_image.style.display = "block";
                width.style.display = "block";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                change_image.setAttribute("src","{{asset('images/Rectangle.webp')}}");
                change_image.style.display = "block";
            }else if(shape == '{{$lang[3]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "block";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/cr_Circle.webp')}}");
            }else if(shape == '{{$lang[4]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "block";
                axis_b.style.display = "block";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/ellipse.webp')}}");
            }else if(shape == '{{$lang[5]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "none";
                side.style.display = "block";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/Pentagon.webp')}}");
            }else if(shape == '{{$lang[6]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "none";
                sides.style.display = "block";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                change_image.style.display = "block";
                change_image.setAttribute("src","{{asset('images/Hexagon.webp')}}");
            }else if(shape == '{{$lang[7]}}'){
                length.style.display = "none";
                width.style.display = "none";
                radius.style.display = "none";
                carpet.style.display = "block";
                sides.style.display = "none";
                side.style.display = "none";
                axis_a.style.display = "none";
                axis_b.style.display = "none";
                change_image.style.display = "none";
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>