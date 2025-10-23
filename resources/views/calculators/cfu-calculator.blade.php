<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="nc" class="font-s-14 text-blue">{!! $lang['1'] !!} [nc]:</label>
                                <input type="number" step="any" name="nc" id="nc" class="input" min="0" aria-label="input" placeholder="00" value="{{ isset(request()->nc)?request()->nc:'9' }}" />
                        </div>
                        <div class="space-y-2">
                            <label for="df" class="font-s-14 text-blue">{!! $lang['2'] !!} [DF]:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="df" id="df" class="input" min="0" aria-label="input" placeholder="00" value="{{ isset(request()->df)?request()->df:'7' }}" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="volume" class="font-s-14 text-blue">{{ $lang['3'] }} [vc]</label>
                        <div class="relative w-full ">
                            <input type="number" name="volume" id="volume" step="any" min="0"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="volume_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_units_dropdown')">{{ isset($_POST['volume_units'])?$_POST['volume_units']:'mm³' }} ▾</label>
                            <input type="text" name="volume_units" value="{{ isset($_POST['volume_units'])?$_POST['volume_units']:'mm³' }}" id="volume_units" class="hidden">
                            <div id="volume_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="volume_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'mm³')">cubic millimeters (mm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cm³')">cubic centimeters (cm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'dm³')">cubic decimeters (dm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'm³')">cubic meters (m³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cu in')">cubic inches (cu in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cu yd')">cubic yards (cu yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'ml')">milliliters (ml)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'cl')">centiliters (cl)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_units', 'l')">liters (l)</p>
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
                        <div class="w-full">
                            @if(isset($detail['cfu']))
                                @php $cfu = round($detail['cfu'],3) @endphp
                                <p><strong class="font-s-18">{!! $lang['4'] !!}</strong></p>
                                <p><strong class="text-[#119154] text-[32px]">{!! $detail['cfu'] !!} m³</strong></p>
                                <p class="mt-3"><strong class="font-s-18">{!! $lang['5'] !!}</strong></p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{(n_c \times DF)}{V_c}\)</p>
                                <p class="mt-2"><strong class="font-s-18">{!! $lang['6'] !!}</strong></p>
                                <p class="mt-2">\( \text{ {!! $lang['7'] !!} } [n_c]  \text{= {!! $detail['nc'] !!}} \)</p>
                                <p class="mt-2">\( \text{ {!! $lang['8'] !!} [DF]  = {!! $detail['df'] !!}}\) </p>
                                <p class="mt-2">\( \text{ {!! $lang['9'] !!} } [V_c]  \text{= {!! $detail['volume'] !!} m³}\)</p>
                                <p class="mt-3"><strong class="font-s-18">{!! $lang['8'] !!}</strong></p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{(n_c \times DF)}{V_c}\)</p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{({!! $detail['nc'] !!} \times {!! $detail['df'] !!})}{ {!! $detail['volume'] !!} }\)</p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{{!! $detail['res'] !!}}{{!! $detail['volume'] !!}}\)</p>
                                <p class="mt-3">\({!! $lang['4'] !!}  = {!! $detail['cfu'] !!} m³\)</p>
                                <p class="mt-4"><strong class="font-s-18">{!! $lang['4'] !!}</strong></p>
                                <div class="col-12 overflow-auto mt-3">
                                    <table class="col-12 col-lg-7" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $lang['12'] !!} {!! $lang['12'] !!}</td>
                                            <td class="border-b py-2 ps-2"><strong>{!! $cfu * 0.001!!}</strong> cells/L</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $lang['12'] !!} {!! $lang['14'] !!}</td>
                                            <td class="border-b py-2 ps-2"><strong>{!! $cfu * 1e-9 !!}</strong> cells/µL</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">{!! $lang['15'] !!} {!! $lang['14'] !!}</td>
                                            <td class="py-2 ps-2"><strong>{!! $cfu * 1E-12 !!}</strong> K/µL</td>
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