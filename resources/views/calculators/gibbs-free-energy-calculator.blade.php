<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="enthalpy" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="enthalpy" id="enthalpy" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['enthalpy'])?$_POST['enthalpy']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="enthalpy_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('enthalpy_units_dropdown')">{{ isset($_POST['enthalpy_units'])?$_POST['enthalpy_units']:'KJ' }} ▾</label>
                                    <input type="text" name="enthalpy_units" value="{{ isset($_POST['enthalpy_units'])?$_POST['enthalpy_units']:'KJ' }}" id="enthalpy_units" class="hidden">
                                    <div id="enthalpy_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="enthalpy_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_units', 'J')">J</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_units', 'KJ')">KJ</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_units', 'cal')">cal</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_units', 'kcal')">kcal</p>
                                    </div>
                                </div>
                            </div>
                       
                        <div class="space-y-2">
                            <label for="entropy" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" name="entropy" id="entropy" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['entropy'])?$_POST['entropy']:'45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="entropy_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('entropy_units_dropdown')">{{ isset($_POST['entropy_units'])?$_POST['entropy_units']:'KJ' }} ▾</label>
                                    <input type="text" name="entropy_units" value="{{ isset($_POST['entropy_units'])?$_POST['entropy_units']:'KJ' }}" id="entropy_units" class="hidden">
                                    <div id="entropy_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="entropy_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_units', 'J')">J</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_units', 'KJ')">KJ</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_units', 'cal')">cal</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_units', 'kcal')">kcal</p>
                                    </div>
                                </div>
                            </div>
                      
                        <div class="space-y-2">
                             <label for="temperature" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="temperature" id="temperature" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temperature'])?$_POST['temperature']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="t_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_units_dropdown')">{{ isset($_POST['t_units'])?$_POST['t_units']:'K' }} ▾</label>
                                <input type="text" name="t_units" value="{{ isset($_POST['t_units'])?$_POST['t_units']:'K' }}" id="t_units" class="hidden">
                                <div id="t_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'K')">K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', '°C')">°C</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', '°F')">°F</p>
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
                    <div class="bg-[#F6FAFC] border rounded  p-3 px-3 py-2">
                        <p>
                            <strong>{!! $lang['4'] !!} =</strong>
                            <strong class="text-[#119154] text-[28px]">{!! round($detail['gibbs'], 2) !!} KJ</strong>
                        </p>
                        <p>{!! ($detail['gibbs'] < 0) ? $lang['9'] : $lang['10'] !!}</p>
                    </div>
                    <div class="grid grid-cols-2  lg:grid-cols-3 md:grid-cols-3  gap-4">
                        <div class="mt-3">
                            <p><strong>J</strong></p>
                            <p>{!! round($detail['gibbs'] * 1000, 2) !!}</p>
                        </div>
                        <div class="border-end d-none d-md-block mt-3">&nbsp;</div>
                        <div class="mt-3">
                            <p><strong>cal</strong></p>
                            <p>{!! round($detail['gibbs'] * 239, 2) !!}</p>
                        </div>
                        <div class="border-end d-none d-md-block mt-3">&nbsp;</div>
                        <div class="mt-3">
                            <p><strong>kcal</strong></p>
                            <p>{!! round($detail['gibbs'] * 0.239, 2) !!}</p>
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="mt-3"><strong>{!! $lang['6'] !!}</strong></p>
                        <p class="mt-2">{!! $lang['1'] !!} : {!! request()->enthalpy . " " . request()->enthalpy_units !!}</p>
                        <p class="mt-2">{!! $lang['2'] !!} : {!! request()->entropy . " " . request()->entropy_units !!} </p>
                        <p class="mt-2">{!! $lang['3'] !!} : {!! request()->temperature . " " . request()->t_units !!}</p>
                        <p class="mt-3"><strong>{!! $lang['7'] !!}</strong></p>
                        <p class="mt-2">{!! $lang['8'] !!} :</p>
                        <p class="mt-2">\( \Delta G = \Delta H - T \times \Delta S \)</p>
                        <p class="mt-2">\( \text {ΔG} = (\text {{!! request()->enthalpy; !!}} - \text {{!! request()->entropy; !!}} \times \text {{!! request()->temperature; !!}}) \)</p>
                        <p class="mt-2">\( \text {ΔG} = \text {{!! round($detail['gibbs'], 2) !!}} \text { KJ}\)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @isset($detail)
    @push('calculatorJS')
    <script>
        function loadMathJax() {
            var mathJaxScript = document.createElement('script');
            mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
            document.querySelector('head').appendChild(mathJaxScript);

            var mathJaxConfigScript = document.createElement('script');
            mathJaxConfigScript.type = "text/x-mathjax-config";
            mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
            document.querySelector('head').appendChild(mathJaxConfigScript);
        }

        window.addEventListener('load', function() {
            loadMathJax();
        });

    </script>
    @endpush
    @endisset
</form>
