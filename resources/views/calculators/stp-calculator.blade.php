<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <label for="volume" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="relative w-full ">
                            <input type="number" name="volume" id="volume" step="any" min="0"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="volume_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_units_dropdown')">{{ isset($_POST['volume_units'])?$_POST['volume_units']:'l' }} ▾</label>
                            <input type="text" name="volume_units" value="{{ isset($_POST['volume_units'])?$_POST['volume_units']:'l' }}" id="volume_units" class="hidden">
                            <div id="volume_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'mm³')">cubic millimeters (mm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cm³')">cubic centimeters (cm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'dm³')">cubic decimeters (dm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'm³')">cubic meters (m³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cu in')">cubic inches (cu in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cu ft')">cubic feet (cu ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cu yd')">cubic yards (cu yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'ml')">milliliters (ml)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cl')">centiliters (cl)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'l')">liters (l)</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="temp" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="temp" id="temp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp'])?$_POST['temp']:'350' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="temp_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_units_dropdown')">{{ isset($_POST['temp_units'])?$_POST['temp_units']:'K' }} ▾</label>
                            <input type="text" name="temp_units" value="{{ isset($_POST['temp_units'])?$_POST['temp_units']:'K' }}" id="temp_units" class="hidden">
                            <div id="temp_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_units', '°C')">°C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_units', '°F')">°F</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_units', 'K')">K</p>
                            </div>
                        </div>
                    </div>
                   <div class="space-y-2">
                        <label for="pressure" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="pressure" id="pressure" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pressure'])?$_POST['pressure']:'850' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="pressure_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pressure_units_dropdown')">{{ isset($_POST['pressure_units'])?$_POST['pressure_units']:'Torr' }} ▾</label>
                            <input type="text" name="pressure_units" value="{{ isset($_POST['pressure_units'])?$_POST['pressure_units']:'Torr' }}" id="pressure_units" class="hidden">
                            <div id="pressure_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'at')">at</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'inHg')">inHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_units', 'mmHg')">mmHg</p>
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
                
                <div class="w-full  bg-light-blue result p-3 radius-10 mt-3">
                    <div class="w-full ">
                        @if(isset($detail['vstp']))
                            @php $v2 = round($detail['vstp'],3) @endphp
                            <div class="col-lg-6">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div>
                                        <p><strong>{!! $lang['4'] !!}</strong></p>
                                        <p><strong class="text-green font-s-32">{!! round($detail['vstp'],3)!!} L</strong></p>
                                    </div>
                                    <div class="border-end d-none d-md-block">&nbsp;</div>
                                    <div>
                                        <p><strong>{!! $lang['5'] !!}</strong></p>
                                        <p><strong class="text-green font-s-32">{!! round($detail['moles'],3)!!}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2"><strong class="font-s-18">{!! $lang['6'] !!}:</strong></p>
                            <p class="mt-2">\(V_{STP} = V \times (\dfrac{273.15}{T}) \times (\dfrac{P}{760})\)</p>
                            <p class="mt-2"><strong class="font-s-18">{!! $lang['7'] !!}:</strong></p>
                            <p class="mt-2">{!! $lang['4'] !!} [V]  = {!! round($detail['volume'],2)!!} L</p>
                            <p class="mt-2">{!! $lang['8'] !!} [T]  = {!! round($detail['temp'],2)!!} K</p>
                            <p class="mt-2">{!! $lang['9'] !!} [P]  = {!! round($detail['pressure'],2)!!} Torr</p>
                            <p class="mt-2"><strong class="font-s-18">{!! $lang['11'] !!}:</strong></p>
                            <p class="mt-2">\(V_{STP} = V \times (\dfrac{273.15}{T}) \times (\dfrac{P}{760})\)</p>
                            <p class="mt-2">\(V_{STP} = {!! $detail['volume']!!} \times (\dfrac{273.15}{{!! $detail['temp']!!}}) \times (\dfrac{{!! $detail['pressure']!!}}{760})\)</p>
                            <p class="mt-2">\(V_{STP} = {!! $detail['volume']!!} \times ({!! round(273.15 / $detail['temp'],4)!!}) \times ({!! round($detail['pressure']/760,4)!!})\)</p>
                            <p class="mt-2 font-s-18">\(V_{STP}\) = <strong>{!! round($detail['vstp'],3)!!} L</strong></p>
                            <p class="mt-3"><strong>{!! $lang['12'] !!}</strong></p>
                            <p class="mt-2">\(Moles_{STP} = \dfrac{V_{STP} }{ 22.4}\)</p>
                            <p class="mt-2">\(Moles_{STP} = \dfrac{ {!! round($detail['vstp'],2)!!} }{ 22.4}\)</p>
                            <p class="mt-2 font-s-18">\(Moles_{STP} \)= <strong>{!! round($detail['moles'],3)!!}</strong></p>
                            <p class="mt-4"><strong class="font-s-18">\(V_{STP}\) {!! $lang['13'] !!}:</strong></p>
                            <div class="col-12 overflow-auto mt-3">
                                <table class="col-12 col-lg-7" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!}  {!! $lang['15'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1000000 !!}</strong> mm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['15'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1000 !!}</strong> cm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['17'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1 !!}</strong> dm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['18'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 0.001 !!}</strong> m³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['19'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 61.024 !!}</strong> cu in</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['20'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 0.035 !!}</strong> cu ft</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['20'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 0.001 !!}</strong> cu yd</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\)  {!! $lang['15'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1000 !!}</strong> ml</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">\(V_{STP}\) {!! $lang['22'] !!}</td>
                                        <td class="py-2 ps-2"><strong>{!! $v2 * 100 !!}</strong> cl</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    


    @endisset
    @push('calculatorJS')
        <script>
            @if(isset($detail))
                function loadMathJax(){
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            @endif
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>