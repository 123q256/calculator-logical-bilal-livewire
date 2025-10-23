<style>
    .border-b{
        border-bottom: 1px solid black!important;
    }
</style>
<form class="w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
         
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6">
                        <label for="len_a" class="font-s-14 text-blue">{{$lang['8']}} a</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="len_a" id="len_a" class="input" value="{{ isset($_POST['len_a'])?$_POST['len_a']:'' }}" aria-label="input" oninput="checkInputs()"/>
                            {{-- <label for="len_a_unit" class="text-blue input-unit ">{{ isset($_POST['len_a_unit'])?$_POST['len_a_unit']:'cm' }} </label>
                            <input type="text" name="len_a_unit" value="{{ isset($_POST['len_a_unit'])?$_POST['len_a_unit']:'cm' }}" id="len_a_unit" class="d-none"> --}}
                            {{-- <div class="units len_a_unit d-none" to="len_a_unit">
                                <p value="mm">millimeters (mm)</p>
                                <p value="cm">centimeters (cm)</p>
                                <p value="m">meters (m)</p>
                                <p value="km">kilometers (km)</p>
                                <p value="in">inches (in)</p>
                                <p value="ft">feets (ft)</p>
                                <p value="yd">yards (yd)</p>
                                <p value="mi">miles (mi)</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="len_b" class="font-s-14 text-blue">{{$lang['8']}} b</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="len_b" id="len_b" class="input" value="{{ isset($_POST['len_b'])?$_POST['len_b']:'' }}" aria-label="input" oninput="checkInputs()"/>
                            {{-- <label for="len_b_unit" class="text-blue input-unit ">{{ isset($_POST['len_b_unit'])?$_POST['len_b_unit']:'cm' }} </label>
                            <input type="text" name="len_b_unit" value="{{ isset($_POST['len_b_unit'])?$_POST['len_b_unit']:'cm' }}" id="len_b_unit" class="d-none"> --}}
                            {{-- <div class="units len_b_unit d-none" to="len_b_unit">
                                <p value="mm">millimeters (mm)</p>
                                <p value="cm">centimeters (cm)</p>
                                <p value="m">meters (m)</p>
                                <p value="km">kilometers (km)</p>
                                <p value="in">inches (in)</p>
                                <p value="ft">feets (ft)</p>
                                <p value="yd">yards (yd)</p>
                                <p value="mi">miles (mi)</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="len_c" class="font-s-14 text-blue">{{$lang['9']}} c</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="len_c" id="len_c" class="input" value="{{ isset($_POST['len_c'])?$_POST['len_c']:'' }}" aria-label="input" oninput="checkInputs()"/>
                            {{-- <label for="len_c_unit" class="text-blue input-unit ">{{ isset($_POST['len_c_unit'])?$_POST['len_c_unit']:'cm' }} </label>
                            <input type="text" name="len_c_unit" value="{{ isset($_POST['len_c_unit'])?$_POST['len_c_unit']:'cm' }}" id="len_c_unit" class="d-none"> --}}
                            {{-- <div class="units len_c_unit d-none" to="len_c_unit">
                                <p value="mm">millimeters (mm)</p>
                                <p value="cm">centimeters (cm)</p>
                                <p value="m">meters (m)</p>
                                <p value="km">kilometers (km)</p>
                                <p value="in">inches (in)</p>
                                <p value="ft">feets (ft)</p>
                                <p value="yd">yards (yd)</p>
                                <p value="mi">miles (mi)</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="angle_alpha" class="font-s-14 text-blue">{{$lang['2']}} α</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="angle_alpha" id="angle_alpha" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_alpha']) ? $_POST['angle_alpha'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="angle_alpha_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_alpha_unit_dropdown')">{{ isset($_POST['angle_alpha_unit'])?$_POST['angle_alpha_unit']:'deg' }} ▾</label>
                            <input type="text" name="angle_alpha_unit" value="{{ isset($_POST['angle_alpha_unit'])?$_POST['angle_alpha_unit']:'deg' }}" id="angle_alpha_unit" class="hidden">
                            <div id="angle_alpha_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_alpha_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_alpha_unit', 'deg')">degrees (deg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_alpha_unit', 'rad')">radians (rad)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12">
                        <label for="angle_beta" class="font-s-14 text-blue">{{$lang['2']}} β</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="angle_beta" id="angle_beta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_beta']) ? $_POST['angle_beta'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="angle_beta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_beta_unit_dropdown')">{{ isset($_POST['angle_beta_unit'])?$_POST['angle_beta_unit']:'deg' }} ▾</label>
                            <input type="text" name="angle_beta_unit" value="{{ isset($_POST['angle_beta_unit'])?$_POST['angle_beta_unit']:'deg' }}" id="angle_beta_unit" class="hidden">
                            <div id="angle_beta_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_beta_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_beta_unit', 'deg')">degrees (deg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_beta_unit', 'rad')">radians (rad)</p>
                            </div>
                         </div>
                    </div>
                    {{-- <div class="col-12 mt-0 mt-lg-2">
                        <label for="area" class="font-s-14 text-blue">{{$lang['1']}}</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="area" id="area" class="input" value="{{ isset($_POST['area'])?$_POST['area']:'' }}" aria-label="input"/>
                            <label for="area_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }} ▾</label>
                            <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }}" id="area_unit" class="d-none">
                            <div class="units area_unit d-none" to="area_unit">
                                <p value="mm²">square millimeters (mm²)</p>
                                <p value="cm²">square centimeters (cm²)</p>
                                <p value="m²">square meters (m²)</p>
                                <p value="km²">square kilometers (km²)</p>
                                <p value="in²">square inches (in²)</p>
                                <p value="ft²">square feets (ft²)</p>
                                <p value="yd²">square yards (yd²)</p>
                                <p value="mi²">square miles (mi²)</p>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                </div>
                <div class="col-span-6 flex justify-center items-center">
                    <div class="w-full">
                        <img src="{{asset('images/trogono_co.png')}}" height="160px" width="220px" alt="trianle details image">
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
                            @if($detail['method'] == "1" || $detail['method'] == "2" || $detail['method'] == "3" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "8" || $detail['method'] == "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "14" || $detail['method'] == "11")
                                <div class="w-full flex justify-center ">
                                    <div class="w-full md:w-[80%] lg:w-[80%] mt-2 border rounded-lg p-3">
                                        <table class="w-full text-[18px] px-lg-3 p-1 py-2">
                                            @if($detail['method'] == "1" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "7" || $detail['method'] == "8" || $detail['method'] == "10" || $detail['method'] == "13" || $detail['method'] == "14" || $detail['method'] == "11")
                                                <tr>
                                                    <td class="py-2 border-b" @if($device == 'desktop') width="50%" @endif><strong>{{$lang['9']}} c</strong></td>
                                                    <td class="py-2 border-b">{{round($detail['c'],2)}} </td>
                                                </tr>
                                            @endif
                                            @if($detail['method'] == "2" || $detail['method'] == "4" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "14")
                                                <tr>
                                                    <td class="py-2 border-b" @if($device == 'desktop') width="50%" @endif><strong>{{$lang['8']}} b</strong></td>
                                                    <td class="py-2 border-b">{{round($detail['b'],2)}} </td>
                                                </tr>
                                            @endif
                                            @if($detail['method'] == "3" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "8" || $detail['method'] == "9" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "14" || $detail['method'] == "11")
                                                <tr>
                                                    <td class="py-2 border-b" @if($device == 'desktop') width="50%" @endif><strong>{{$lang['8']}} a</strong></td>
                                                    <td class="py-2 border-b">{{round($detail['a'],2)}} </td>
                                                </tr>
                                            @endif
                                            @if($detail['method'] != "4" && $detail['method'] != "5" && $detail['method'] != "6" || $detail['method'] == "8" || $detail['method'] == "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "14" || $detail['method'] == "11")
                                                @php
                                                    $radians = $detail['anglea'];
                                                    $degreesa = round($radians * (180 / pi()), 3);
                                                @endphp
                                                @if($detail['method'] != "13")
                                                    <tr>
                                                        <td class="py-2 border-b" @if($device == 'desktop') width="50%" @endif><strong>{{$lang['2']}} α</strong></td>
                                                        @if($_POST['angle_beta_unit'] === 'deg')
                                                        <td class="py-2 border-b flex align-items-center"> <span id="result_value">{{$degreesa}}</span>
                                                            <div class=" py-2 px-2 position-relative">
                                                                <select class="input" name="to_cal" id="to_cal">
                                                                    <option value="c" > °</option>
                                                                    <option value="rad" > rad</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        @else
                                                        <td class="py-2 border-b flex align-items-center"> <span id="result_value">{{round($detail['anglea'],3)}}</span>
                                                            <div class=" py-2 px-2 position-relative">
                                                                <select class="input" name="to_cal" id="to_cal">
                                                                    <option value="rad" > rad</option>
                                                                    <option value="c" > °</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endif
                                            @if($detail['method'] != "7" && $detail['method'] != "8" && $detail['method'] != "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "11")
                                                @php
                                                    $radians = $detail['angleb'];
                                                    $degrees = round($radians * (180 / pi()), 3);
                                                @endphp
                                                <tr>
                                                    <td class="py-2 border-b" @if($device == 'desktop') width="50%" @endif><strong>{{$lang['2']}} β</strong></td>
                                                    @if($_POST['angle_beta_unit'] === 'deg')
                                                        <td class="py-2 border-b flex align-items-center"> <span id="result_valueb">{{$degrees}}</span>
                                                            <div class=" py-2 px-2 position-relative">
                                                                <select class="input" name="to_calb" id="to_calb">
                                                                    <option value="c" > °</option>
                                                                    <option value="rad" > rad</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td class="py-2 border-b flex align-items-center"> <span id="result_valueb">{{round($detail['angleb'],3)}}</span>
                                                            <div class=" py-2 px-2 position-relative">
                                                                <select class="input" name="to_calb" id="to_calb">
                                                                    <option value="rad" > rad</option>
                                                                    <option value="c" > °</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                            {{-- @if($detail['method'] != "10" && $detail['method'] != "11" && $detail['method'] != "12" && $detail['method'] != "13" && $detail['method'] != "14") --}}
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['ht'] ?? "Height"}}</strong></td>
                                                <td class="py-2 border-b">{{round($detail['height'],3)}} </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['ar'] ?? "Area"}}</strong></td>
                                                <td class="py-2 border-b">{{round($detail['area'],3)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['per'] ?? "Perimeter"}}</strong></td>
                                                <td class="py-2 border-b">{{round($detail['peremter'],3)}} </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['cir'] ?? "Circumradius"}}</strong></td>
                                                <td class="py-2 border-b">{{round($detail['R_cap'],3)}} </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 " width="35%"><strong>{{$lang['inr'] ?? "Inradius"}}</strong></td>
                                                <td class="py-2 ">{{round($detail['R_sml'],3)}} </td>
                                            </tr>
                                            {{-- @endif --}}
                                        </table>
                                    </div>
                                </div>
                            @endif
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['3']}}</strong></p>
                                @if($detail['method'] == "1" || $detail['method'] == "2" || $detail['method'] == "3" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "8" || $detail['method'] == "9")
                                    @if($detail['method'] == "2" || $detail['method'] == "4" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "9")
                                        <p class="mt-2"><strong>{{$lang['4']}} b:</strong></p>
                                        <p class="mt-2">\( b=\sqrt{(c^2-a^2)} \)</p>
                                        <p class="mt-2">\( b=\sqrt{({{ round($detail['c'],2) }}^2-{{ round($detail['a'],2) }}^2)} \)</p>
                                        <p class="mt-2">\( b=\sqrt{({{ pow(round($detail['c'],2), 2) }}-{{ pow(round($detail['a'],2), 2) }})} \)</p>
                                        <p class="mt-2">\( b={{ round($detail['b'],2) }} \)</p>
                                    @endif
                                    @if ($detail['method'] == "1" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "7" || $detail['method'] == "8")
                                        <p class="mt-2"><strong>{{$lang['4'] }} c:</strong></p>
                                        <p class="mt-2">\( c=\sqrt{(a^2+b^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ round($detail['a'],2) }}^2+{{ round($detail['b'],2) }}^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ pow(round($detail['a'],2), 2) }}+{{ pow(round($detail['b'],2), 2) }})} \)</p>
                                        <p class="mt-2">\( c={{ round($detail['c'],2) }} \)</p>
                                    @endif
                                    @if ($detail['method'] == "3" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "8" || $detail['method'] == "9")
                                        <p class="mt-2"><strong>{{$lang['4'] }} a:</strong> </p>
                                        <p class="mt-2">\( a=\sqrt{(c^2-b^2)} \)</p>
                                        <p class="mt-2">\( a=\sqrt{({{ round($detail['c'],2) }}^2-{{ round($detail['b'],2) }}^2)} \)</p>
                                        <p class="mt-2">\( a=\sqrt{({{ pow(round($detail['c'],2), 2) }}-{{ pow(round($detail['b'],2), 2) }})} \)</p>
                                        <p class="mt-2">\( a={{ round($detail['a'],2) }} \)</p>
                                    @endif
                                    @if ($detail['method'] != "4" && $detail['method'] != "5" && $detail['method'] != "6")
                                        <p class="mt-2"><strong>{{$lang['5'] }} α:</strong> </p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{a}{b}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{{{ round($detail['a'],2) }}}{{{ round($detail['b'],2) }}}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan({{ round($detail['a'] / $detail['b'],2) }}) \)</p>
                                        <p class="mt-2">\( \alpha= {{ round($detail['anglea'],3) }} \) rad</p>
                                        <p class="mt-2">\( \alpha= {{$degreesa}} \) °</p>
                                    @endif
                                    @if ($detail['method'] != "7" && $detail['method'] != "8" && $detail['method'] != "9")
                                        <p class="mt-2"><strong>{{$lang['5'] }} β:</strong> </p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{b}{a}) \)</p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{{{ round($detail['b'],2) }}}{{{ round($detail['a'],2) }}}) \)</p>
                                        <p class="mt-2">\( \beta= arctan({{ round($detail['b'] / $detail['a'],2) }}) \)</p>
                                        <p class="mt-2">\( \beta= {{ round($detail['angleb'],3) }} \) rad</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                                    @endif
                                @endif
                                {{-- @if($detail['method'] != "10" && $detail['method'] != "11" && $detail['method'] != "12" && $detail['method'] != "13" && $detail['method'] != "14")
                                    <p class="mt-2"><strong> Find Are</strong> :</p>
                                    <p class="mt-2">\( area=\dfrac{a*b}{2} \)</p>
                                    <p class="mt-2">\( area=\dfrac{ {{round($detail['a'],2)}} * {{round($detail['b'],2)}} }{2} \)</p>
                                    <p class="mt-2">\( area= {{round($detail['area'],2)}} \)</p>
                                @endif --}}
                                @if ($detail['method'] == "10" || $detail['method'] == "11" || $detail['method'] == "12" || $detail['method'] == "13")
                                    @if ($detail['method'] != "12" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find c :</strong></p>
                                        <p class="mt-2">\( c=\sqrt{(a^2+b^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ round($detail['a'],2)}}^2+{{ round($detail['b'],2)}}^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ pow(round($detail['a'],2), 2)}}+{{ pow(round($detail['b'],2), 2)}})} \)</p>
                                        <p class="mt-2">\( c={{ round($detail['c'],2)}} \)</p>
                                    @endif
                                    @if ($detail['method'] == "10" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find b :</strong></p>
                                        <p class="mt-2">\( b=\dfrac{2*area}{a} \)</p>
                                        <p class="mt-2">\( b=\dfrac{2*{{ round($detail['area'],2)}}}{{{ round($detail['a'],2)}}} \)</p>
                                        <p class="mt-2">\( b={{ round($detail['b'],2)}} \)</p>
                                    @endif
                                    @if ($detail['method'] == "11" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find a :</strong></p>
                                        <p class="mt-2">\( a=\dfrac{2*area}{b} \)</p>
                                        <p class="mt-2">\( a=\dfrac{2*{{ round($detail['area'],2)}}}{{{ round($detail['b'],2)}}} \)</p>
                                        <p class="mt-2">\( a={{ round($detail['a'],2)}} \)</p>
                                    @endif
                                    @if ($detail['method'] == "12" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find a :</strong></p>
                                        <p class="mt-2">\( a=\sqrt{\dfrac{c^2+\sqrt{c^4-16*a^2}}{2}}\)</p>
                                        <p class="mt-2">\( a=\sqrt{\dfrac{ {{ round($detail['c'],2)}}^2+\sqrt{ {{ round($detail['c'],2)}}^4-16*{{ round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( a=\sqrt{\dfrac{ {{ round($detail['c'],2)}}^2+\sqrt{ {{ round($detail['c'],2)}}^4-16*{{ round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( a= {{round($detail['a'],2)}}\)</p>
                                        <p class="mt-2"><strong> Find b :</strong></p>
                                        <p class="mt-2">\( b=\sqrt{\dfrac{c^2-\sqrt{c^4-16*a^2}}{2}}\)</p>
                                        <p class="mt-2">\( b=\sqrt{\dfrac{ {{ round($detail['c'],2)}}^2-\sqrt{ {{ round($detail['c'],2)}}^4-16*{{ round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( b=\sqrt{\dfrac{ {{ round($detail['c'],2)}}^2-\sqrt{ {{ round($detail['c'],2)}}^4-16*{{ round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( b={{round($detail['b'],2)}}\)</p>
                                    @endif
                                    @if ($detail['method'] != "13")
                                        <p class="mt-2"> <strong>{{$lang['5']}} α:</strong></p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{a}{b}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{{{round($detail['a'],2)}}}{{{round($detail['b'],2)}}}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan({{round($detail['a'],2) / round($detail['b'],2)}}) \)</p>
                                        <p class="mt-2">\( \alpha= {{round($detail['anglea'],3)}} \) rad</p>
                                        <p class="mt-2"> <strong>{{$lang['5']}} β:</strong></p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{b}{a}) \)</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                
                                        <p class="mt-2">\( \beta= arctan(\dfrac{{{round($detail['b'],2)}}}{{{round($detail['a'],2)}}}) \)</p>
                                        <p class="mt-2">\( \beta= arctan({{round($detail['b'] / $detail['a'],2)}}) \)</p>
                                        <p class="mt-2">\( \beta= {{round($detail['angleb'],3)}} \) rad</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                                    @endif
                                @endif
                                @if ($detail['method'] == "13" || $detail['method'] == "14")
                                    <p class="mt-2"> <strong>Find a :</strong></p>
                                    <p class="mt-2">\( a=\sqrt{2*area*tan(α)} \)</p>
                                    <p class="mt-2">\( a=\sqrt{2*{{round($detail['area'],2)}}*tan({{round($detail['anglea'],2)}})} \)</p>
                                    <p class="mt-2">\( a={{round($detail['a'],2)}} \)</p>
                                    <p class="mt-2"><strong> Find b :</strong> </p>
                                    <p class="mt-2">\( b=\sqrt{\dfrac{2*area}{tan(α)}} \)</p>
                                    <p class="mt-2">\( b=\sqrt{\dfrac{2*{{round($detail['area'],2)}}}{tan({{round($detail['anglea'],2)}})}} \)</p>
                                    <p class="mt-2">\( b={{round($detail['b'],2)}} \)</p>
                                    <p class="mt-2"><strong> Find c :</strong> </p>
                                    <p class="mt-2">\( c=\sqrt{(a^2+b^2)} \)</p>
                                    <p class="mt-2">\( c=\sqrt{({{round($detail['a'],2)}}^2+{{round($detail['b'],2)}}^2)} \)</p>
                                    <p class="mt-2">\( c=\sqrt{({{pow(round($detail['a'],2), 2)}}+{{pow(round($detail['b'],2), 2)}})} \)</p>
                                    <p class="mt-2">\( c={{round($detail['c'],3)}} \)</p>
                                    @if ($detail['method'] == "13" && $detail['method'] != "14")
                                        <p class="mt-2"><strong>{{$lang['5']}} β : </strong></p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{b}{a}) \)</p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{{{round($detail['b'],2)}}}{{{round($detail['a'],2)}}}) \)</p>
                                        <p class="mt-2">\( \beta= arctan({{round($detail['b'] / $detail['a'],2)}}) \)</p>
                                        <p class="mt-2">\( \beta= {{round($detail['angleb'],3)}} \) rad</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                
                                    @endif
                                    @if ($detail['method'] == "14" && $detail['method'] != "13")
                                        <p class="mt-2"><strong>{{$lang['5']}} α :</strong> </p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{a}{b}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{{{round($detail['a'],2)}}}{{{round($detail['b'],2)}}}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan({{round($detail['a'] / $detail['b'],2)}}) \)</p>
                                        <p class="mt-2">\( \alpha= {{round($detail['anglea'],3)}} \) rad</p>
                                        <p class="mt-2">\( \alpha= {{$degreesa}} \) °</p>
                
                                    @endif
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
    @if(isset($detail))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
        <script>
             var selectElement = document.getElementById('to_cal');
                if (selectElement) {
                    var resultValueElement = document.getElementById('result_value');
                    selectElement.addEventListener('change', function() {
                        var selectedValue = selectElement.value;
                        var value_result = {{ round($detail['anglea'], 4) }};
                        if (selectedValue == 'rad') {
                            resultValueElement.innerText = value_result;
                        } else if (selectedValue == 'c') {
                            var resultValue = value_result * (180 / Math.PI);
                            let roundedValue = parseFloat(resultValue.toFixed(4));
                            resultValueElement.innerText = roundedValue;
                        }
                    });
                }
            var selectElementb = document.getElementById('to_calb');
            var resultValueElementb = document.getElementById('result_valueb');
            selectElementb.addEventListener('change', function() {
                var selectedValue = selectElementb.value;
                var value_result = "{{round($detail['angleb'],4)}}";
                if(selectedValue == 'rad'){
                    resultValueElementb.innerText =  "{{round($detail['angleb'],4)}}";
                }else if(selectedValue == 'c'){
                    resultValue = value_result * (180 / Math.PI);
                    let roundedValueb = parseFloat(resultValue.toFixed(3));
                    resultValueElementb.innerText = roundedValueb;
                }
            });
        </script>
    @endif
        <script>
            function checkInputs() {
                const inputs = [
                    document.getElementById('len_a'),
                    document.getElementById('len_b'),
                    document.getElementById('len_c'),
                    document.getElementById('angle_alpha'),
                    document.getElementById('angle_beta'),
                ];
                let filledCount = 0;
                
                // First, handle the case for angle inputs specifically
                const angleAlpha = document.getElementById('angle_alpha');
                const angleBeta = document.getElementById('angle_beta');
                
                if (angleAlpha.value.trim() !== '') {
                    angleBeta.disabled = true;
                    angleBeta.style.backgroundColor = 'gainsboro';
                } else {
                    angleBeta.disabled = false;
                    angleBeta.style.backgroundColor = '';
                }
                
                if (angleBeta.value.trim() !== '') {
                    angleAlpha.disabled = true;
                    angleAlpha.style.backgroundColor = 'gainsboro';
                } else {
                    angleAlpha.disabled = false;
                    angleAlpha.style.backgroundColor = '';
                }

                // Now, check how many inputs (excluding the angles if one is already disabled) are filled
                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                if (filledCount === 2) {
                    inputs.forEach(input => {
                        if (input.value.trim() === '') {
                            input.disabled = true;
                            input.style.backgroundColor = 'gainsboro';
                        }
                    });
                } else {
                    inputs.forEach(input => {
                        if (!((input === angleAlpha && angleBeta.value.trim() !== '') || (input === angleBeta && angleAlpha.value.trim() !== ''))) {
                            input.disabled = false;
                            input.style.backgroundColor = '';
                        }
                    });
                }
            }

            checkInputs();
        </script>
@endpush
