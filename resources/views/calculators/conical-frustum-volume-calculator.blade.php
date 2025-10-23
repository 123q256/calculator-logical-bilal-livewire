<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="choose" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <select name="choose" class="input" id="choose" aria-label="select">
                            <option value="r_h">{{"$lang[2] s, V, L, A | $lang[3] r1, r2, h"}}</option>
                            <option value="r_sh" {{ isset($_POST['choose']) && $_POST['choose']=='r_sh'?'selected':'' }}>{{"$lang[2] h, V, L, A | $lang[3] r1, r2, s"}}</option>
                            <option value="r_v" {{ isset($_POST['choose']) && $_POST['choose']=='r_v'?'selected':'' }}>{{"$lang[2] h, s, L, A | $lang[3] r1, r2, V"}}</option>
                            <option value="r_l" {{ isset($_POST['choose']) && $_POST['choose']=='r_l'?'selected':'' }}>{{"$lang[2] h, s, V, A | $lang[3] r1, r2, L"}}</option>
                            <option value="r_a" {{ isset($_POST['choose']) && $_POST['choose']=='r_a'?'selected':'' }}>{{"$lang[2] h, s, V, L | $lang[3] r1, r2, A"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="first" class="font-s-14 text-blue">{{$lang['4']}} (r<sub class="font-s-14">1</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="first_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('first_unit_dropdown')">{{ isset($_POST['first_unit'])?$_POST['first_unit']:'cm' }} ▾</label>
                        <input type="text" name="first_unit" value="{{ isset($_POST['first_unit'])?$_POST['first_unit']:'cm' }}" id="first_unit" class="hidden">
                        <div id="first_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="first_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'mi')">miles (mi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="second" class="font-s-14 text-blue">{{$lang['4']}} (r<sub class="font-s-14">2</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="second_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('second_unit_dropdown')">{{ isset($_POST['second_unit'])?$_POST['second_unit']:'cm' }} ▾</label>
                        <input type="text" name="second_unit" value="{{ isset($_POST['second_unit'])?$_POST['second_unit']:'cm' }}" id="second_unit" class="hidden">
                        <div id="second_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="second_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'mi')">miles (mi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="third" class="font-s-14 text-blue" id="f3_text">
                        @if (isset($_POST['choose']) && $_POST['choose'] === 'r_sh')
                            {{$lang[8]}} (s)
                        @elseif (isset($_POST['choose']) && $_POST['choose'] === 'r_v')
                            {{$lang[9]}} (V)
                        @elseif (isset($_POST['choose']) && $_POST['choose'] === 'r_l')
                            {{$lang[14]}} (L)
                        @elseif (isset($_POST['choose']) && $_POST['choose'] === 'r_a')
                            {{$lang[15]}} (A)
                        @else
                            {{$lang['5']}} (h)
                        @endif
                    </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="third_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('third_unit_dropdown')">{{ isset($_POST['third_unit'])?$_POST['third_unit']:'cm' }} ▾</label>
                        <input type="text" name="third_unit" value="{{ isset($_POST['third_unit'])?$_POST['third_unit']:'cm' }}" id="third_unit" class="hidden">
                        <div id="third_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="third_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('third_unit', 'mi')">miles (mi)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="pi_val" class="font-s-14 text-blue">{{$lang[6]}} π</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="pi_val" id="pi_val" class="input" value="{{ isset($_POST['pi_val'])?$_POST['pi_val']:'3.14159265359' }}" aria-label="input"/>
                    </div>
                </div>
            </div>
            <div class="col-span-6">
                @if($device === "desktop")
                    <div class="col-12 text-center mt-3 flex justify-center items-center">
                        <img src="{{asset('images/new_frustum.webp')}}" height="100%" width="56%" alt="Volume of Frustum Cone image" loading="lazy" decoding="async">
                    </div>
                    @endif

                <div class="col-12 mt-0 mt-lg-2">
                    <label for="units" class="font-s-14 text-blue">{{$lang['7']}}:</label>
                    <div class="w-full py-2">
                        <select name="units" class="input" id="units" aria-label="select">
                            <option value="cm">cm</option>
                            <option value="mm" {{ isset($_POST['units']) && $_POST['units']=='mm'?'selected':'' }}>mm</option>
                            <option value="m" {{ isset($_POST['units']) && $_POST['units']=='m'?'selected':'' }}>m</option>
                            <option value="km" {{ isset($_POST['units']) && $_POST['units']=='km'?'selected':'' }}>km</option>
                            <option value="in" {{ isset($_POST['units']) && $_POST['units']=='in'?'selected':'' }}>in</option>
                            <option value="ft" {{ isset($_POST['units']) && $_POST['units']=='ft'?'selected':'' }}>ft</option>
                            <option value="yd" {{ isset($_POST['units']) && $_POST['units']=='yd'?'selected':'' }}>yd</option>
                            <option value="mi" {{ isset($_POST['units']) && $_POST['units']=='mi'?'selected':'' }}>mi</option>
                        </select>
                    </div>
                </div>
                @if($device === "mobile")
                    <div class="col-12 text-center mt-3 flex justify-center items-center">
                        <img src="{{asset('images/new_frustum.webp')}}" height="100%" width="35%" alt="Volume of Frustum Cone image" loading="lazy" decoding="async">
                    </div>
                @endif
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (r<sub class="font-s-14">1</sub>)</strong></td>
                                    <td class="py-2 border-b">{{$detail['radius_1']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (r<sub class="font-s-14">2</sub>)</strong></td>
                                    <td class="py-2 border-b">{{$detail['radius_2']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['height']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['slant_height']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['volume']}} {{$_POST['units']}}³</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['lsa']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['tsa']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['bsa']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['ttsa']}} {{$_POST['units']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('choose').addEventListener('change', function() {
                var f3Text = document.getElementById('f3_text');
                if (this.value === "r_sh") {
                    f3Text.textContent = "{{$lang['8']}} (s)";
                } else if (this.value === "r_v") {
                    f3Text.innerHTML = "{{$lang[9]}} (V)";
                } else if (this.value === "r_l") {
                    f3Text.textContent = "{{$lang[14]}} (L)";
                } else if (this.value === "r_a") {
                    f3Text.textContent = "{{$lang[15]}} (A)";
                } else {
                    f3Text.textContent = "{{$lang['5']}} (h)";
                }
            });
        </script>
    @endpush
</form>