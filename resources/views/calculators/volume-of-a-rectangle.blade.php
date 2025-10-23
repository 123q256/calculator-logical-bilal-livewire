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
                            <label for="choose" class="label">{{$lang['1']}}:</label>
                            <div class="w-full py-2">
                                <select name="choose" class="input" id="choose" aria-label="select">
                                    <option value="hlw">{{"$lang[2] V, S, d | $lang[3] h, l, w"}}</option>
                                    <option value="slw" {{ isset($_POST['choose']) && $_POST['choose']=='slw'?'selected':'' }}>{{"$lang[2] h, V, d | $lang[3] S, l, w"}}</option>
                                    <option value="vlw" {{ isset($_POST['choose']) && $_POST['choose']=='vlw'?'selected':'' }}>{{"$lang[2] h, S, d | $lang[3] V, l, w"}}</option>
                                    <option value="dlw" {{ isset($_POST['choose']) && $_POST['choose']=='dlw'?'selected':'' }}>{{"$lang[2] h, V, S | $lang[3] d, l, w"}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="first" class="label">{{$lang['4']}} (l)</label>
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
                        <div class="col-span-12">
                            <label for="second" class="label">{{$lang['5']}} (w)</label>
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
                        <div class="col-span-12">
                            <label for="third" class="label" id="f3_text">
                                @if (isset($_POST['choose']) && $_POST['choose'] === 'slw')
                                    {{$lang[14]}} S<sub class='font-s-12 text-blue'>tot</sub>
                                @elseif (isset($_POST['choose']) && $_POST['choose'] === 'vlw')
                                    {{$lang[8]}} (V)
                                @elseif (isset($_POST['choose']) && $_POST['choose'] === 'dlw')
                                    {{$lang[9]}} (d)
                                @else
                                    {{$lang['6']}} (h)
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
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    @if($device === "desktop")
                        <div class=" col-span-12 text-center mt-3 flex items-center justify-center">
                            <img src="{{asset('images/new_volume_rec.webp')}}" height="100%" width="80%" alt="Volume of a Rectangular Prism Image" loading="lazy" decoding="async">
                        </div>
                    @endif
                    <div class="col-span-12">
                        <label for="units" class="label">{{$lang['7']}}:</label>
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
                        <div class="col-span-12 text-center mt-3 flex items-center justify-center">
                            <img src="{{asset('images/new_volume_rec.webp')}}" height="100%" width="50%" alt="Volume of a Rectangular Prism Image" loading="lazy" decoding="async">
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
                            <div class="col-lg-6 mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['volume_ans']}} {{$_POST['units']}}</td>
                                    </tr>
                                </table>
                                <table class="w-full font-s-16 mt-2">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['5']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['width']}} {{$_POST['units']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['6']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['height']}} {{$_POST['units']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['9']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['diagonal']}} {{$_POST['units']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['10']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_tot']}} {{$_POST['units']}}²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['11']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_lat']}} {{$_POST['units']}}²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['12']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_top']}} {{$_POST['units']}}²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['13']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_btm']}} {{$_POST['units']}}²</strong></td>
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
                if (this.value === "hlw") {
                    f3Text.textContent = "{{$lang[6]}} (h)";
                } else if (this.value === "slw") {
                    f3Text.innerHTML = "{{$lang[14]}} S<sub class='font-s-12 text-blue'>tot</sub>";
                } else if (this.value === "vlw") {
                    f3Text.textContent = "{{$lang[8]}} (V)";
                } else {
                    f3Text.textContent = "{{$lang[9]}} (d)";
                }
            });
        </script>
    @endpush
</form>