<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="method" class="font-s-14 text-blue">{!! $lang['to_cal'] !!}:</label>
                    <select name="method" id="method" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['p'],$lang['t'],$lang['v'],$lang['s']];
                            $val = ["press","temp","volume","sub"];
                            optionsList($val,$name,isset(request()->method)?request()->method:'press');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue" id="x_text"></label>
                   <div class="relative w-full ">
                       <input type="number" name="x" id="x" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x'])?$_POST['x']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
               
                       <div class="x_v_unit_label">
                            <label for="x_v_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x_v_unit_dropdown')">{{ isset($_POST['x_v_unit'])?$_POST['x_v_unit']:'m³' }} ▾</label>
                            <input type="text" name="x_v_unit" value="{{ isset($_POST['x_v_unit'])?$_POST['x_v_unit']:'m³' }}" id="x_v_unit" class="hidden">
                            <div id="x_v_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[70%] md:w-[70%] w-[90%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_v_unit', 'm³')">cubic meters (m³)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_v_unit', 'cm³')">cubic centimeters (cm³)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_v_unit', 'mm³')">cubic mmillimeters (mm³)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_v_unit', 'dm³')">cubic decimeters (dm³)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_v_unit', 'ft³')">cubic feet (ft³)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_v_unit', 'in³')">cubic inches (in³)</p>
                            </div>
                       </div>
                       <div class="x_t_unit_label hidden">
                           <label for="x_t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x_t_unit_dropdown')">{{ isset($_POST['x_t_unit'])?$_POST['x_t_unit']:'°C' }} ▾</label>
                            <input type="text" name="x_t_unit" value="{{ isset($_POST['x_t_unit'])?$_POST['x_t_unit']:'°C' }}" id="x_t_unit" class="hidden">
                            <div id="x_t_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_t_unit', '°C')">Celsius (°C)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_t_unit', 'K')">>Kelvin (K)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x_t_unit', '°F')">Fahrenheit (°F)</p>
                            </div>
                       </div>
                   </div>
               </div>
               <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue" id="y_text"></label>
                    <div class="relative w-full ">
                        <input type="number" name="y" id="y" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y'])?$_POST['y']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                
                        <div class="y_s_unit_label">
                                <label for="y_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y_s_unit_dropdown')">{{ isset($_POST['y_s_unit'])?$_POST['y_s_unit']:'mol' }} ▾</label>
                                <input type="text" name="y_s_unit" value="{{ isset($_POST['y_s_unit'])?$_POST['y_s_unit']:'mol' }}" id="y_s_unit" class="hidden">
                                <div id="y_s_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[40%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_s_unit', 'mol')">mol</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_s_unit', 'µmol')">µmol</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_s_unit', 'mmol')">mmol</p>
                                </div>

                        </div>
                        <div class="y_p_unit_label hidden">
                            <label for="y_p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y_p_unit_dropdown')">{{ isset($_POST['y_p_unit'])?$_POST['y_p_unit']:'Pa' }} ▾</label>
                                <input type="text" name="y_p_unit" value="{{ isset($_POST['y_p_unit'])?$_POST['y_p_unit']:'Pa' }}" id="y_p_unit" class="hidden">
                                <div id="y_p_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[40%] mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'Pa')">Pa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'psi')">>psi</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'bar')">bar</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'atm')">atm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'at')">at</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'Torr')">Torr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'mmHg')">mmHg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y_p_unit', 'kPa')">kPa</p>
                                </div>
                        </div>
                    </div>
               </div>
               <div class="space-y-2">
                    <label for="z" class="font-s-14 text-blue" id="z_text"></label>
                    <div class="relative w-full ">
                        <input type="number" name="z" id="z" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z'])?$_POST['z']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                
                        <div class="z_t_unit_label">
                                <label for="z_t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z_t_unit_dropdown')">{{ isset($_POST['z_t_unit'])?$_POST['z_t_unit']:'°C' }} ▾</label>
                                <input type="text" name="z_t_unit" value="{{ isset($_POST['z_t_unit'])?$_POST['z_t_unit']:'°C' }}" id="z_t_unit" class="hidden">
                                <div id="z_t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_t_unit', '°C')">Celsius (°C)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_t_unit', 'K')">Kelvin (K)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_t_unit', '°F')">Fahrenheit (°F)</p>
                                </div>
                        </div>
                        <div class="z_p_unit_label hidden">
                            <label for="z_p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z_p_unit_dropdown')">{{ isset($_POST['z_p_unit'])?$_POST['z_p_unit']:'Pa' }} ▾</label>
                                <input type="text" name="z_p_unit" value="{{ isset($_POST['z_p_unit'])?$_POST['z_p_unit']:'Pa' }}" id="z_p_unit" class="hidden">
                                <div id="z_p_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'Pa')">Pa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'psi')">>psi</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'bar')">bar</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'atm')">atm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'at')">at</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'Torr')">Torr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'mmHg')">mmHg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z_p_unit', 'kPa')">kPa</p>
                                </div>
                        </div>
                    </div>
               </div>
               <div class="space-y-2 relative">
                    <label for="R" class="font-s-14 text-blue">{!! $lang['2'] !!} (R):</label>
                    <input type="number" step="any" name="R" id="R" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->R)?request()->R:'8.3144626' }}" />
                    <span class="text-blue input_unit">J⋅K⁻¹⋅mol⁻¹</span>
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
                    <div class="w-full p-3 rounded-lg mt-3">
                        <div class="w-full">
                            <p class="mt-2 font-bold" id="ans"></p>
                            <p class="mb-2 text-[#119154] text-2xl font-bold">{{ isset($detail['ans']) ? $detail['ans'] : '0.0' }}</p>
                            <p class="font-bold">{{ $lang[1] }}</p>
                            <div class="w-full overflow-auto mt-2">
                                @if(request()->method == 'press')
                                <table class="w-full lg:w-7/12">
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['p'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] / 6894.757, 5) }} psi</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['p'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] / 100000, 5) }} bar</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['p'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] / 101325, 5) }} atm</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['p'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] / 98067, 5) }} at</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['p'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] / 133.322, 5) }} Torr</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['p'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] / 133.322, 5) }} mmHg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $lang['p'] }}</td>
                                        <td class="py-2 font-bold">{{ round($detail['ans1'] / 1000, 5) }} kPa</td>
                                    </tr>
                                </table>
                                @elseif(request()->method == 'sub')
                                <table class="w-full lg:w-7/12">
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['s'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1e+6, 5) }} μmol</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $lang['s'] }}</td>
                                        <td class="py-2 font-bold">{{ round($detail['ans1'] * 1000, 5) }} mmol</td>
                                    </tr>
                                </table>
                                @elseif(request()->method == 'volume')
                                <table class="w-full lg:w-7/12">
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['v'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1e+6, 5) }} cm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['v'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1e+9, 5) }} mm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['v'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 1000, 5) }} dm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['v'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] * 35.315, 5) }} ft³</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $lang['v'] }}</td>
                                        <td class="py-2 font-bold">{{ round($detail['ans1'] * 61024, 5) }} in³</td>
                                    </tr>
                                </table>
                                @elseif(request()->method == 'temp')
                                <table class="w-full lg:w-7/12">
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['t'] }}</td>
                                        <td class="border-b py-2 font-bold">{{ round($detail['ans1'] - 273.15, 5) }} °C</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $lang['t'] }}</td>
                                        <td class="py-2 font-bold">{{ round(($detail['ans1'] - 273.15) * 9/5 + 32, 5) }} °F</td>
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
    @push('calculatorJS')
        <script>
            function updateLabels(method) {
                let x, y, z, ans;
                if (method === 'press') {
                    x = "{{ $lang['v'] }}";
                    y = "{{ $lang['s'] }}";
                    z = "{{ $lang['t'] }}";
                    ans = "{{ $lang['p'] }}";
                    document.querySelector('.x_v_unit_label').style.display = 'block';
                    document.querySelector('.x_t_unit_label').style.display = 'none';
                    document.querySelector('.y_s_unit_label').style.display = 'block';
                    document.querySelector('.y_p_unit_label').style.display = 'none';
                    document.querySelector('.z_t_unit_label').style.display = 'block';
                    document.querySelector('.z_p_unit_label').style.display = 'none';
                } else if (method === 'volume') {
                    x = "{{ $lang['t'] }}";
                    y = "{{ $lang['s'] }}";
                    z = "{{ $lang['p'] }}";
                    ans = "{{ $lang['v'] }}";
                    document.querySelector('.x_t_unit_label').style.display = 'block';
                    document.querySelector('.x_v_unit_label').style.display = 'none';
                    document.querySelector('.y_s_unit_label').style.display = 'block';
                    document.querySelector('.y_p_unit_label').style.display = 'none';
                    document.querySelector('.z_p_unit_label').style.display = 'block';
                    document.querySelector('.z_t_unit_label').style.display = 'none';
                } else if (method === 'temp') {
                    x = "{{ $lang['v'] }}";
                    y = "{{ $lang['s'] }}";
                    z = "{{ $lang['p'] }}";
                    ans = "{{ $lang['t'] }}";
                    document.querySelector('.x_v_unit_label').style.display = 'block';
                    document.querySelector('.x_t_unit_label').style.display = 'none';
                    document.querySelector('.y_s_unit_label').style.display = 'block';
                    document.querySelector('.y_p_unit_label').style.display = 'none';
                    document.querySelector('.z_p_unit_label').style.display = 'block';
                    document.querySelector('.z_t_unit_label').style.display = 'none';
                } else {
                    x = "{{ $lang['v'] }}";
                    y = "{{ $lang['p'] }}";
                    z = "{{ $lang['t'] }}";
                    ans = "{{ $lang['s'] }}";
                    document.querySelector('.x_v_unit_label').style.display = 'block';
                    document.querySelector('.x_t_unit_label').style.display = 'none';
                    document.querySelector('.y_p_unit_label').style.display = 'block';
                    document.querySelector('.y_s_unit_label').style.display = 'none';
                    document.querySelector('.z_t_unit_label').style.display = 'block';
                    document.querySelector('.z_p_unit_label').style.display = 'none';
                }
                document.getElementById('x_text').textContent = x;
                document.getElementById('y_text').textContent = y;
                document.getElementById('z_text').textContent = z;
                @php if(isset($detail)){ @endphp
                    document.getElementById('ans').textContent = ans;
                @php } @endphp
            }

            // Initial setup
            let method = document.getElementById('method').value;
            updateLabels(method);

            // Event listener for method change
            document.getElementById('method').addEventListener('change', function() {
                method = this.value;
                updateLabels(method);
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>