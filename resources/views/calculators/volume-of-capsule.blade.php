<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12">
                            <label for="choose" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                            <div class="w-full py-2">
                                <select name="choose" class="input" id="choose" aria-label="select">
                                    <option value="a_r">{{"$lang[2] V, S, C | $lang[3] r, a"}}</option>
                                    <option value="v_r" {{ isset($_POST['choose']) && $_POST['choose']=='v_r'?'selected':'' }}>{{"$lang[2] a, S, C | $lang[3] r, V"}}</option>
                                    <option value="s_r" {{ isset($_POST['choose']) && $_POST['choose']=='s_r'?'selected':'' }}>{{"$lang[2] a, V, C | $lang[3] r, S"}}</option>
                                    <option value="c_a" {{ isset($_POST['choose']) && $_POST['choose']=='c_a'?'selected':'' }}>{{"$lang[2] r, V, S | $lang[3] a, C"}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="first" class="font-s-14 text-blue" id="f1_text">
                                @if(isset($_POST['choose']) && $_POST['choose'] === "c_a")
                                    {{$lang[5]}} (a)
                                @else
                                    {{$lang[4]}} (r)
                                @endif
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="first_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('first_unit_dropdown')">{{ isset($_POST['first_unit'])?$_POST['first_unit']:'kg' }} ▾</label>
                                <input type="text" name="first_unit" value="{{ isset($_POST['first_unit'])?$_POST['first_unit']:'kg' }}" id="first_unit" class="hidden">
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
                        <div class="col-span-12">
                            <label for="second" class="font-s-14 text-blue" id="f2_text">
                                @if(isset($_POST['choose']) && $_POST['choose'] === "c_a")
                                    {{$lang[10]}} (C)
                                @elseif(isset($_POST['choose']) && $_POST['choose'] === "v_r")
                                    {{$lang[8]}} (V)
                                @elseif(isset($_POST['choose']) && $_POST['choose'] === "s_r")
                                    {{$lang[9]}} (S)
                                @else
                                    {{$lang[5]}} (a)
                                @endif
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="second_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('second_unit_dropdown')">{{ isset($_POST['second_unit'])?$_POST['second_unit']:'kg' }} ▾</label>
                                <input type="text" name="second_unit" value="{{ isset($_POST['second_unit'])?$_POST['second_unit']:'kg' }}" id="second_unit" class="hidden">
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
                        <div class="col-span-12">
                            <label for="pi_val" class="font-s-14 text-blue">{{$lang[6]}} π</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="pi_val" id="pi_val" class="input" value="{{ isset($_POST['pi_val'])?$_POST['pi_val']:'3.14159265359' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    @if($device === "desktop")
                        <div class="col-span-12  flex justify-center">
                            <img src="{{asset('images/new_volume-cap.webp')}}" height="100%" width="65%" alt="Volume of Capsule image" loading="lazy" decoding="async">
                        </div>
                    @endif
                    <div class="col-span-12">
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
                        <div class="col-span-12 flex justify-center">
                            <img src="{{asset('images/new_volume-cap.webp')}}" height="100%" width="40%" alt="Volume of Capsule image" loading="lazy" decoding="async">
                        </div>
                    @endif
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['volume']}} {{$_POST['units']}}³</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['surface']}} {{$_POST['units']}}²</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['circumference']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['radius']}} {{$_POST['units']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['side']}} {{$_POST['units']}}</td>
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
                var f1Text = document.getElementById('f1_text');
                var f2Text = document.getElementById('f2_text');
                if (this.value === "a_r") {
                    f1Text.textContent = "{{$lang['4']}} (r)";
                    f2Text.textContent = "{{$lang['5']}} (a)";
                } else if (this.value === "v_r") {
                    f1Text.textContent = "{{$lang['4']}} (r)";
                    f2Text.textContent = "{{$lang['8']}} (V)";
                } else if (this.value === "s_r") {
                    f1Text.textContent = "{{$lang['4']}} (r)";
                    f2Text.textContent = "{{$lang['9']}} (S)";
                } else {
                    f1Text.textContent = "{{$lang['5']}} (a)";
                    f2Text.textContent = "{{$lang['10']}} (C)";
                }
            });
        </script>
    @endpush
</form>