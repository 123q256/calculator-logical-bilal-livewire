<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6  div_center">
                <label for="calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="calculate" id="calculate">
                        <option value="4" {{ isset($_POST['calculate']) && $_POST['calculate']=='4'?'selected':''}}>{{$lang[8]}} </option>
                        <option value="1" {{ isset($_POST['calculate']) && $_POST['calculate']=='1'?'selected':''}}>{{$lang[2]}} </option>              
                        <option value="2" {{ isset($_POST['calculate']) && $_POST['calculate']=='2'?'selected':''}}>{{$lang[3]}} </option>             
                        <option value="3" {{ isset($_POST['calculate']) && $_POST['calculate']=='3'?'selected':''}}>{{$lang[4]}} </option>              
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  friction_coefficient">
                <label for="fr_co" class="font-s-14 text-blue">{{ $lang['2'] }} (μ)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="fr_co" id="fr_co" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['fr_co'])?$_POST['fr_co']:'0.2' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  normal_force hidden">
                <label for="force" class="font-s-14 text-blue">{{ $lang['3'] }} (N)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="force" id="force" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force']) ? $_POST['force'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('force_unit_dropdown')">{{ isset($_POST['force_unit'])?$_POST['force_unit']:'N' }} ▾</label>
                    <input type="text" name="force_unit" value="{{ isset($_POST['force_unit'])?$_POST['force_unit']:'N' }}" id="force_unit" class="hidden">
                    <div id="force_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="force_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'MN')">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'GN')">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'TN')">TN</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  friction hidden">
                <label for="fr" class="font-s-14 text-blue">{{ $lang['4'] }} (F)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fr" id="fr" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fr']) ? $_POST['fr'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fr_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fr_unit_dropdown')">{{ isset($_POST['fr_unit'])?$_POST['fr_unit']:'N' }} ▾</label>
                    <input type="text" name="fr_unit" value="{{ isset($_POST['fr_unit'])?$_POST['fr_unit']:'N' }}" id="fr_unit" class="hidden">
                    <div id="fr_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fr_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'MN')">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'GN')">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'TN')">TN</p>
                    </div>
                 </div>
            </div>
          
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6  mass">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['5'] }} (m)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="mass" id="mass" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['mass'])?$_POST['mass']:'13' }}" />
                    <span class="text-blue input_unit">kg</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  plane">
                <label for="plane" class="font-s-14 text-blue">{{ $lang['6'] }} (θ)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="plane" id="plane" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['plane'])?$_POST['plane']:'13' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  gravity">
                <label for="gravity" class="font-s-14 text-blue">{{ $lang['7'] }} (g)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="gravity" id="gravity" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['gravity'])?$_POST['gravity']:'9.81' }}" />
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
                    <div class="w-full overflow-auto">
                        <div class="w-full text-[18px]">
                            @if(isset($detail['friction_coefficient']) && $detail['friction_coefficient']!="")
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                   <tr>
                                      <td class="py-2 border-b" width="70%"><strong>{{ $lang[2] }} (μ)</strong></td>
                                       <td class="py-2 border-b"> {{round($detail['friction_coefficient'],2)}}</td>
                                   </tr>
                                </table>
                            </div>
                                <p class="mt-2"><span>{{$lang['9']}}</p>
                                <p class="mt-2">\(\text{μ = F / N}\)</p>
                                <p class="mt-2"><span>{{$lang['10']}}</p>
                                <p class="mt-2">\(\text{F - {{$lang['4']}} = {{$detail['fr_value']}} N}\)</p>
                                <p class="mt-2">\(\text{N - {{$lang['3']}} = {{$detail['force_value']}} N}\)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">\(\text{μ =} \dfrac{F}{N}\)</p>
                                <p class="mt-2">\(\text{μ} = \dfrac{ {{$detail['fr_value']}} }{{{$detail['force_value']}}}\)</p>
                                <p class="mt-2">\(\text{μ =}\) <strong>\({{round($detail['friction_coefficient'],2)}}\)</strong></p>
                            @endif
                            @if(isset($detail['calculate_force']) && $detail['calculate_force']!="")
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                   <tr>
                                      <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }}</strong></td>
                                       <td class="py-2 border-b"> {{round($detail['calculate_force'],2)}}(N) </td>
                                   </tr>
                                </table>
                            </div>
                                <p class="mt-2"><span>{{ $lang['9']}}</p>
                                <p class="mt-2">\(\text{N =}\dfrac{F}{μ}\)</p>
                                <p class="mt-2">\(\text{F - {{ $lang['4']}} = {{ $detail['force_value']}} N}\)</p>
                                <p class="mt-2">\(\text{μ - {{ $lang['2']}} = {{ $detail['fr_co']}}}\)</p>
                                <p class="mt-2">{{ $lang['11']}}</p>
                                <p class="mt-2">\(\text{N =}\dfrac{F}{μ}\)</p>
                                <p class="mt-2">\(\text{N =}\dfrac{ {{ $detail['force_value']}} }{{{ $detail['fr_co']}}}\)</p>
                                <p class="mt-2">\(\text{N =}\) <strong>\({{ round($detail['calculate_force'],2)}} (N)\)</strong></p>
                            @endif
                            @if(isset($detail['friction']) && $detail['friction']!="")
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                   <tr>
                                      <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }}</strong></td>
                                       <td class="py-2 border-b"> {{round($detail['friction'],2)}} (N) </td>
                                   </tr>
                                </table>
                            </div>
                                <p class="col m12 s12 margin_top_20"><span>{{$lang['9']}} </p>
                                <p class="mt-2">\(\text{F = N} \times \text{μ} \)</p>
                                <p class="mt-2">\(\text{N - {{$lang['3']}} = {{$detail['force_value']}} N}\)</p>
                                <p class="mt-2">\(\text{μ - {{$lang['2']}} = {{$detail['fr_co']}}}\)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">\(\text{F = N} \times \text{μ}\)</p>
                                <p class="mt-2">\(\text{F = {{$detail['force_value']}}} \times \text{{{$detail['fr_co']}}}\)</p>
                                <p class="mt-2">\(\text{F =}\) <strong>\({{round($detail['friction'],2)}} (N)\)</strong></p>
                            @endif
                            @if(isset($detail['friction2']) && $detail['friction2']!="")
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                   <tr>
                                      <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] }}</strong></td>
                                       <td class="py-2 border-b"> {{round($detail['friction2'],2)}} (N) </td>
                                   </tr>
                                </table>
                            </div>
                                <p class="col m12 s12 margin_top_20"><span>{{$lang['9']}} </p>
                                <p class="mt-2">\(F_{friction} = μ \times m \times [g] \times cos(θ)\)</p>
                                <p class="col m12 s12 margin_top_20"><span>{{$lang['10']}}</p>
                                <p class="mt-2">\(\text{μ - {{$lang['2']}} = {{$detail['fr_co']}}}\)</p>
                                <p class="mt-2">\(\text{m - {{$lang['5']}} =  {{$detail['mass']}} kg}\)</p>
                                <p class="mt-2">\(\text{g - {{$lang['12']}} = {{$detail['gravity']}} m/s²}\)</p>
                                <p class="mt-2">\(\text{cos(θ) - {{$lang['6']}} = {{$detail['plane']}} Deg => {{round($detail['read'],4)}} Rad }\)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">\(F_{friction} = μ \times m \times [g] \times cos(θ)\)</p>
                                <p class="mt-2">\(F_{friction} = {{$detail['fr_co']}} \times {{$detail['mass']}} \times {{$detail['gravity']}} \times {{round($detail['read'],4)}}\)</p>
                                <p class="mt-2">\(F_{friction}\) = <strong>\({{round($detail['friction2'],2)}} (N)\)</strong></p>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset

    
 @push('calculatorJS')
 @if(isset($detail))
     <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
     <script type="text/x-mathjax-config">
         MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
     </script>
 @endif
 <script>
     @if(isset($error))
        var a = "{{$_POST['calculate']}}";
            var elements = {
                normal_force: document.querySelectorAll('.normal_force'),
                friction: document.querySelectorAll('.friction'),
                friction_coefficient: document.querySelectorAll('.friction_coefficient'),
                mass: document.querySelectorAll('.mass'),
                plane: document.querySelectorAll('.plane'),
                gravity: document.querySelectorAll('.gravity')
            };
            function showElements(...els) {
                for (let key in elements) {
                    if (els.includes(key)) {
                        elements[key].forEach(el => el.classList.remove('hidden'));
                    } else {
                        elements[key].forEach(el => el.classList.add('hidden'));
                    }
                }
            }
            if (a == "1") {
                showElements('normal_force', 'friction');
            } else if (a == "2") {
                showElements('friction_coefficient', 'friction');
            } else if (a == "3") {
                showElements('friction_coefficient', 'normal_force');
            } else if (a == "4") {
                showElements('friction_coefficient', 'mass', 'plane', 'gravity');
            }
    @endif
    @if(isset($detail))
        var a = "{{$_POST['calculate']}}";
            var elements = {
                normal_force: document.querySelectorAll('.normal_force'),
                friction: document.querySelectorAll('.friction'),
                friction_coefficient: document.querySelectorAll('.friction_coefficient'),
                mass: document.querySelectorAll('.mass'),
                plane: document.querySelectorAll('.plane'),
                gravity: document.querySelectorAll('.gravity')
            };

            function showElements(...els) {
                for (let key in elements) {
                    if (els.includes(key)) {
                        elements[key].forEach(el => el.classList.remove('hidden'));
                    } else {
                        elements[key].forEach(el => el.classList.add('hidden'));
                    }
                }
            }

            if (a == "1") {
                showElements('normal_force', 'friction');
            } else if (a == "2") {
                showElements('friction_coefficient', 'friction');
            } else if (a == "3") {
                showElements('friction_coefficient', 'normal_force');
            } else if (a == "4") {
                showElements('friction_coefficient', 'mass', 'plane', 'gravity');
            }
    @endif
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('calculate').addEventListener('change', function() {
            var a = this.value;
            var elements = {
                normal_force: document.querySelectorAll('.normal_force'),
                friction: document.querySelectorAll('.friction'),
                friction_coefficient: document.querySelectorAll('.friction_coefficient'),
                mass: document.querySelectorAll('.mass'),
                plane: document.querySelectorAll('.plane'),
                gravity: document.querySelectorAll('.gravity')
            };

            function showElements(...els) {
                for (let key in elements) {
                    if (els.includes(key)) {
                        elements[key].forEach(el => el.classList.remove('hidden'));
                    } else {
                        elements[key].forEach(el => el.classList.add('hidden'));
                    }
                }
            }

            if (a == "1") {
                showElements('normal_force', 'friction');
            } else if (a == "2") {
                showElements('friction_coefficient', 'friction');
            } else if (a == "3") {
                showElements('friction_coefficient', 'normal_force');
            } else if (a == "4") {
                showElements('friction_coefficient', 'mass', 'plane', 'gravity');
            }
        });
    });
 </script>
@endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>