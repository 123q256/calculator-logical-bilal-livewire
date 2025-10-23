<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="screen" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="screen" id="screen" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang[13], $lang['14'], $lang['15'], "1:1", "5:3", "3:2", "2:1", "5;4", $lang['16']];
                            $val = ["16:9", "4:3", "16:10", "17:10", "1:2.35", "21:9", "32:9", "1:1", "5:3", "3:2", "2:1", "5;4", "custom"];
                            optionsList($val,$name,isset(request()->screen)?request()->screen: '16:9');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ratio_1" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" name="ratio_1" id="ratio_1" class="input" aria-label="input"  value="{{ isset(request()->ratio_1)?request()->ratio_1: '16'}}" />
                    <span class="input_unit text-blue">:</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ratio_2" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="ratio_2" id="ratio_2" class="input" aria-label="input"  value="{{ isset(request()->ratio_2)?request()->ratio_2:'9' }}" />
                    <span class="input_unit text-blue">:</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="type" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <select name="type" id="type" class="input">
                        @php
                           $name = ["Flat", "Curved"];
                                $val = ["flat", "curved"];
                            optionsList($val,$name,isset(request()->type)?request()->type: 'flat');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 carvature hidden">
                <label for="curvature" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <select name="curvature" id="curvature" class="input">
                        @php
                           $name = ["1500R", "1800R", "2300R", "3000R", "4000R", "Enter your own value"];
                                    $val = ["1500", "1800", "2300", "3000", "4000", "enter"];
                            optionsList($val,$name,isset(request()->curvature)?request()->curvature: '1500');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 radius hidden">
                <label for="radius" class="label">{{ $lang['6'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="radius" id="radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius']) ? $_POST['radius'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="radius_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_units_dropdown')">{{ isset($_POST['radius_units'])?$_POST['radius_units']:'in' }} ▾</label>
                    <input type="text" name="radius_units" value="{{ isset($_POST['radius_units'])?$_POST['radius_units']:'in' }}" id="radius_units" class="hidden">
                    <div id="radius_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_units">
                        @foreach ( ["mm", "cm", "m", "in", "ft", "yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>

         
            <div class="col-span-12 md:col-span-6 lg:col-span-6 select_one ">
                <label for="select_one" class="label">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <select name="select_one" id="select_one" class="input">
                        @php
                            $name = [$lang['18'], $lang['19'], $lang['8']];
                            $val = ["width", "height", "diagonal"];
                            optionsList($val,$name,isset(request()->select_one)?request()->select_one: 'diagonal');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 select_two hidden">
                <label for="select_two" class="label">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <select name="select_two" id="select_two" class="input">
                        @php
                            $name = [$lang['21'], $lang['19'], $lang['8']];
                            $val = ["Width", "Height", "Diagonal"];
                            optionsList($val,$name,isset(request()->select_two)?request()->select_two: 'Width');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 flat_dem">
                <label for="flat_dimensions" class="label" id="s_one">{{ $lang['8'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="flat_dimensions" id="flat_dimensions" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['flat_dimensions']) ? $_POST['flat_dimensions'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="flat_dimensions_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('flat_dimensions_units_dropdown')">{{ isset($_POST['flat_dimensions_units'])?$_POST['flat_dimensions_units']:'in' }} ▾</label>
                    <input type="text" name="flat_dimensions_units" value="{{ isset($_POST['flat_dimensions_units'])?$_POST['flat_dimensions_units']:'in' }}" id="flat_dimensions_units" class="hidden">
                    <div id="flat_dimensions_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="flat_dimensions_units">
                        @foreach ( ["mm", "cm", "m", "in", "ft", "yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('flat_dimensions_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 carved_dem hidden">
                <label for="curved_dimensions" class="label" id="s_two">{{ $lang['21'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="curved_dimensions" id="curved_dimensions" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['curved_dimensions']) ? $_POST['curved_dimensions'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="curved_dimensions_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('curved_dimensions_units_dropdown')">{{ isset($_POST['curved_dimensions_units'])?$_POST['curved_dimensions_units']:'in' }} ▾</label>
                    <input type="text" name="curved_dimensions_units" value="{{ isset($_POST['curved_dimensions_units'])?$_POST['curved_dimensions_units']:'in' }}" id="curved_dimensions_units" class="hidden">
                    <div id="curved_dimensions_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="curved_dimensions_units">
                        @foreach ( ["mm", "cm", "m", "in", "ft", "yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('curved_dimensions_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
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
 @else
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
     <div class="">
         @if ($type == 'calculator')
         @include('inc.copy-pdf')
         @endif
         <div class="rounded-lg  flex items-center justify-center">
                 <div class="w-full mt-3">
                     @php
                         $type = request()->type;
                         $curvature = request()->curvature;
                         $radius = request()->radius;
                         $radius_units = request()->radius_units;
                         $select_one = request()->select_one;
                         $select_two = request()->select_two;
                     @endphp
                     <div class="w-full py-2">
                         <div class="w-full md:w-[80%] lg:w-[80% text-18px">
                             <table class="w-full">
                                 @if($type === 'flat')
                                     <tr>
                                         <td width="60%" class="border-b py-2"><strong>{{ $lang['17'] }} :</strong></td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'], 3)}} <span class="font-s-14">in²</span></td>
                                     </tr>
                                     @if ($type === 'flat' && $select_one === 'height')
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['diagonal'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['18'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['width'], 1) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                     @elseif ($type === 'flat' && $select_one === 'width')
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['diagonal'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['height'], 1) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                     @else
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['height'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['18'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['width']) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                     @endif
                                     <tr>
                                         <td colspan="2" class="pt-2">{{$lang['20']}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">mm² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 645.16, 2)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">cm² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 6.4516, 1)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">dm² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.0645, 3)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">m² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.00064516, 5)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">ft² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.00064516, 5)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">yd² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.00007122, 5)}}</td>
                                     </tr>
                                 @else
                                     <tr>
                                         <td width="60%" class="border-b py-2"><strong>{{ $lang['17'] }} :</strong></td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'], 3)}} <span class="font-s-14">in²</span></td>
                                     </tr>
                                     @if ($type === 'curved' && $select_two === 'Height')
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['21'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['base_width'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['diagonal'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                     @elseif ($type === 'curved' && $select_two === 'Width')
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['height'], 1) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['diagonal'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                     @elseif ($type === 'curved' && $select_two === 'Diagonal') 
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['height'], 2) }} <span class="font-s-14">in</span></td>
                                         </tr>
                                         <tr>
                                             <td class="border-b py-2"><strong>{{ $lang['21'] }}</strong> :</td>
                                             <td class="border-b py-2">{{round($detail['base_width']),2 }} <span class="font-s-14">in</span></td>
                                         </tr>
                                     @endif
                                     <tr>
                                         <td class="border-b py-2"><strong>{{ $lang['22'] }}</strong> :</td>
                                         <td class="border-b py-2">{{round($detail['base_depth'], 2) }} <span class="font-s-14">in</span></td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2"><strong>{{ $lang['23'] }}</strong> :</td>
                                         <td class="border-b py-2">{{round($detail['screen_length']),2 }} <span class="font-s-14">in</span></td>
                                     </tr>
                                     <tr>
                                         <td colspan="2" class="pt-2">{{$lang['20']}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">mm² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 645.16, 2)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">cm² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 6.4516, 1)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">dm² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.0645, 3)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">m² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.00064516, 5)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">ft² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.00064516, 5)}}</td>
                                     </tr>
                                     <tr>
                                         <td class="border-b py-2">yd² :</td>
                                         <td class="border-b py-2">{{ round($detail['screenArea'] * 0.00007122, 5)}}</td>
                                     </tr>
                                 @endif
                             </table>
                         </div>
                     </div>
                     <div class="col-12 text-center mt-[20px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                     </div>
                 </div>
            </div>
        </div>
    </div>
    @endif
</form>
@push('calculatorJS')
    <script>
        var carved_dem = document.querySelector('.carved_dem');
        var flat_dem = document.querySelector('.flat_dem');
        var select_one = document.querySelector('.select_one');
        var select_two = document.querySelector('.select_two');
        var radius = document.querySelector('.radius');
        var carvature = document.querySelector('.carvature');
        document.getElementById('type').addEventListener('change',function(){
            var type = this.value;
            if(type == 'flat'){
                flat_dem.style.display = "block";
                select_one.style.display = "block";
                select_two.style.display = "none";
                carved_dem.style.display = "none";
                radius.style.display = "none";
                carvature.style.display = "none";
            }else{
                flat_dem.style.display = "none";
                select_two.style.display = "block";
                select_one.style.display = "none";
                carved_dem.style.display = "block";
                radius.style.display = "none";
                carvature.style.display = "block";
            }
        });
        document.getElementById('curvature').addEventListener('change',function(){
            var curvature = this.value;
            if(curvature == 'enter'){
                radius.style.display = "block";
            }else{
                radius.style.display = "none";
            }
        });
        document.getElementById('select_one').addEventListener('change', function(){
            s_one=document.getElementById('s_one');
            var select_one = this.value;
            if(select_one == 'width'){
                s_one.innerHTML = "{{$lang['18']}}:";
            }else if(select_one=='height'){
                s_one.innerHTML = "{{$lang['19']}}:";
            }else{
                s_one.innerHTML = "{{$lang['8']}}:";
            }
        });
        document.getElementById('select_two').addEventListener('change', function(){
            s_two=document.getElementById('s_two');
            var select_one = this.value;
            if(select_one == 'Width'){
                s_two.innerHTML = "{{$lang['21']}}:";
            }else if(select_one=='Height'){
                s_two.innerHTML = "{{$lang['19']}}:";
            }else{
                s_two.innerHTML = "{{$lang['8']}}:";
            }
        });

        function handleInputChange() {
            var value = this.value;
            if (value !== '') {
                var unit = document.getElementById('screen').value;
                value = value.split(':');
                document.getElementById('ratio_1').value = value[0];
                document.getElementById('ratio_2').value = value[1];
            }
        }
        document.getElementById('screen').addEventListener('change', handleInputChange);
    </script>
@endpush