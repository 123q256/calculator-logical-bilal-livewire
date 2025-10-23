<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">


            <div class="col-span-12">
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="calculation" class="font-s-14 text-blue">{{ $lang[1] }}</label>
                    <div class="w-full py-2 position-relative">
                        <select name="calculation" id="calculation" class="input" onchange="change_calculation(this)">
                            <option value="from1"
                                {{ isset($_POST['calculation']) && $_POST['calculation'] == 'from1' ? 'selected' : '' }}>Find
                                n1 | Given n2, θ₁ and θ₂</option>
                            <option value="from2"
                                {{ isset($_POST['calculation']) && $_POST['calculation'] == 'from2' ? 'selected' : '' }}
                                selected>Find n2 | Given n1, θ₁ and θ₂</option>
                            <option value="from3"
                                {{ isset($_POST['calculation']) && $_POST['calculation'] == 'from3' ? 'selected' : '' }}>Find
                                θ₁ | Given n1, n2 and θ₂</option>
                            <option value="from4"
                                {{ isset($_POST['calculation']) && $_POST['calculation'] == 'from4' ? 'selected' : '' }}>Find
                                θ₂ | Given n1, n2 and θ₁</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 flex justify-center">
                <img src="{{ asset('images/snells_img.svg') }}" alt="Triangle Image" width="250px">
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 medium_index_1" id="medium_index_1">
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="medium1" class="font-s-14 text-blue">{{ $lang[12] }} 1</label>
                    <div class="w-full py-2 position-relative">
                        <select name="medium1" id="medium1" class="input" onchange="medium_change_f(this)">
                            <option value="vacuum"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'vacuum' ? 'selected' : '' }}>
                                {{ $lang[2] }}</option>
                            <option value="air"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'air' ? 'selected' : '' }}>
                                {{ $lang[3] }}</option>
                            <option value="water"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'water' ? 'selected' : '' }}>
                                {{ $lang[4] }} 20°C 🌊</option>
                            <option value="ethanol"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'ethanol' ? 'selected' : '' }}>
                                {{ $lang[5] }}</option>
                            <option value="ice"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'ice' ? 'selected' : '' }}>
                                {{ $lang[6] }} 🧊</option>
                            <option value="acrylic"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'acrylic' ? 'selected' : '' }}>
                                {{ $lang[7] }}</option>
                            <option value="window"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'window' ? 'selected' : '' }}>
                                {{ $lang[8] }}</option>
                            <option value="diamond"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'diamond' ? 'selected' : '' }}>
                                {{ $lang[9] }}</option>
                            <option value="custom"
                                {{ isset($_POST['medium1']) && $_POST['medium1'] == 'custom' ? 'selected' : '' }}>
                                {{ $lang[10] }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2 medium_index_1" id="medium_index_1">
                <label for="n1" class="font-s-14 text-blue">{{ $lang['11'] }} 1 (n₁)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="n1" id="n1" class="input" aria-label="input"
                        placeholder="50" value="{{ isset($_POST['n1']) ? $_POST['n1'] : '1' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden medium_index_2" id="medium_index_2">
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="medium2" class="font-s-14 text-blue">{{ $lang[12] }} 2</label>
                    <div class="w-full py-2 position-relative">
                        <select name="medium2" id="medium2" class="input" onchange="medium_change_s(this)">
                            <option value="vacuum"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'vacuum' ? 'selected' : '' }}>
                                {{ $lang[2] }}</option>
                            <option value="air"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'air' ? 'selected' : '' }}>
                                {{ $lang[3] }}</option>
                            <option value="water"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'water' ? 'selected' : '' }}>
                                {{ $lang[4] }} 20°C 🌊</option>
                            <option value="ethanol"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'ethanol' ? 'selected' : '' }}>
                                {{ $lang[5] }}</option>
                            <option value="ice"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'ice' ? 'selected' : '' }}>
                                {{ $lang[6] }} 🧊</option>
                            <option value="acrylic"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'acrylic' ? 'selected' : '' }}>
                                {{ $lang[7] }}</option>
                            <option value="window"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'window' ? 'selected' : '' }}>
                                {{ $lang[8] }}</option>
                            <option value="diamond"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'diamond' ? 'selected' : '' }}>
                                {{ $lang[9] }}</option>
                            <option value="custom"
                                {{ isset($_POST['medium2']) && $_POST['medium2'] == 'custom' ? 'selected' : '' }}>
                                {{ $lang[10] }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2 medium_index_2 hidden" id="medium_index_2">
                <label for="n2" class="font-s-14 text-blue">{{ $lang['11'] }} 2 (n₂)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="n2" id="n2" class="input" aria-label="input"
                        placeholder="50" value="{{ isset($_POST['n2']) ? $_POST['n2'] : '1.000293' }}" />
                </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2" id="angle1">
                <label for="angle_first" class="font-s-14 text-blue">{{ $lang['13'] }} (θ₁)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="angle_first" id="angle_first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_first']) ? $_POST['angle_first'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="angle_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_f_unit_dropdown')">{{ isset($_POST['angle_f_unit']) ? $_POST['angle_f_unit'] : 'deg' }} ▾</label>
                   <input type="text" name="angle_f_unit" value="{{ isset($_POST['angle_f_unit']) ? $_POST['angle_f_unit'] : 'deg' }}" id="angle_f_unit" class="hidden">
                   <div id="angle_f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_f_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'deg')">deg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'rad')">rad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'gon')">gon</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'tr')">tr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'arcmin')">arcmin</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'arcsec')">arcsec</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'mrad')">mrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', 'μrad')">μrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_f_unit', '* π rad')">* π rad</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2" id="angle2">
                <label for="angle_second" class="font-s-14 text-blue">{{ $lang['13'] }} (θ₂)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="angle_second" id="angle_second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_second']) ? $_POST['angle_second'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="angle_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_s_unit_dropdown')">{{ isset($_POST['angle_s_unit']) ? $_POST['angle_s_unit'] : 'deg' }} ▾</label>
                   <input type="text" name="angle_s_unit" value="{{ isset($_POST['angle_s_unit']) ? $_POST['angle_s_unit'] : 'deg' }}" id="angle_s_unit" class="hidden">
                   <div id="angle_s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_s_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'deg')">deg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'rad')">rad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'gon')">gon</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'tr')">tr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'arcmin')">arcmin</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'arcsec')">arcsec</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'mrad')">mrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', 'μrad')">μrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_s_unit', '* π rad')">* π rad</p>
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
                        <div class="w-full text-[18px]">
                            @if ($detail['calculation'] === 'from1')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[11] }} 1 (n₁)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'], 6) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">{{ $lang[17] }} = (n₂ * sin(θ₂)) / sin(θ₁)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">n₁ = ({{ $_POST['n2'] }} * sin({{ $detail['angle_second'] }})) /
                                        sin({{ $detail['angle_first'] }})</p>
                                    <p class="mt-2">n₁ = {{ round($detail['jawab'], 6) }}</p>
                                </div>
                            @elseif($detail['calculation'] === 'from2')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[11] }} 2 (n₂)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'], 6) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">{{ $lang[17] }} = (n₁ * sin(θ₁)) / sin(θ₂)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">n₂ = ({{ $_POST['n1'] }} * sin({{ $detail['angle_first'] }})) /
                                        sin({{ $detail['angle_second'] }})</p>
                                    <p class="mt-2">n₂ = {{ round($detail['jawab'], 6) }}</p>
                                </div>
                            @elseif($detail['calculation'] === 'from3')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} (θ₁)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'] * 57.2958, 6) }} deg</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">{{ $lang[17] }} = sin<sup>-1</sup>((n₂ * sin(θ₂)) / n₁)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">θ₁ = sin<sup>-1</sup>(({{ $_POST['n1'] }} *
                                        sin({{ $detail['angle_second'] }})) / {{ $_POST['n1'] }});</p>
                                    <p class="mt-2">θ₁ = {{ round($detail['jawab'] * 57.2958, 6) }}</p>
                                </div>
                            @else
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} (θ₂)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'] * 57.2958, 6) }} deg</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">{{ $lang[17] }} = sin<sup>-1</sup>((n₁ * sin(θ₁)) / n₂)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">θ₁ = sin<sup>-1</sup>(( {{ $_POST['n1'] }} *
                                        sin({{ $detail['angle_first'] }})) / {{ $_POST['n1'] }})</p>
                                    <p class="mt-2">θ₁ = {{ round($detail['jawab'] * 57.2958, 6) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
        MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
    </script>
    @endif
    <script>
        function change_calculation(element) {
            let method = element.value;
            let mediumIndex1 = document.querySelectorAll('.medium_index_1');
            let mediumIndex2 = document.querySelectorAll('.medium_index_2');
            let angle1 = document.getElementById('angle1');
            let angle2 = document.getElementById('angle2');

            function showElements(elements) {
                elements.forEach(element => element.classList.remove('hidden'));
            }

            function hideElements(elements) {
                elements.forEach(element => element.classList.add('hidden'));
            }

            if (method === "from1") {
                showElements(mediumIndex2);
                angle1.classList.remove('hidden');
                hideElements(mediumIndex1);
            } else if (method === "from2") {
                showElements(mediumIndex1);
                angle1.classList.remove('hidden');
                hideElements(mediumIndex2);
            } else if (method === "from3") {
                showElements(mediumIndex1);
                showElements(mediumIndex2);
                angle2.classList.remove('hidden');
                angle1.classList.add('hidden');
            } else {
                showElements(mediumIndex1);
                showElements(mediumIndex2);
                angle1.classList.remove('hidden');
                angle2.classList.add('hidden');
            }
        }
        @if (isset($detail))
            var method = "{{ $_POST['calculation'] }}";

            let mediumIndex1 = document.querySelectorAll('.medium_index_1');
            let mediumIndex2 = document.querySelectorAll('.medium_index_2');
            let angle1 = document.getElementById('angle1');
            let angle2 = document.getElementById('angle2');

            function showElements(elements) {
                elements.forEach(element => element.classList.remove('hidden'));
            }

            function hideElements(elements) {
                elements.forEach(element => element.classList.add('hidden'));
            }

            if (method === "from1") {
                showElements(mediumIndex2);
                angle1.classList.remove('hidden');
                hideElements(mediumIndex1);
            } else if (method === "from2") {
                showElements(mediumIndex1);
                angle1.classList.remove('hidden');
                hideElements(mediumIndex2);
            } else if (method === "from3") {
                showElements(mediumIndex1);
                showElements(mediumIndex2);
                angle2.classList.remove('hidden');
                angle1.classList.add('hidden');
            } else {
                showElements(mediumIndex1);
                showElements(mediumIndex2);
                angle1.classList.remove('hidden');
                angle2.classList.add('hidden');
            }
        @endif
        @if (isset($error))
            var method = "{{ $_POST['calculation'] }}";

            let mediumIndex1 = document.querySelectorAll('.medium_index_1');
            let mediumIndex2 = document.querySelectorAll('.medium_index_2');
            let angle1 = document.getElementById('angle1');
            let angle2 = document.getElementById('angle2');

            function showElements(elements) {
                elements.forEach(element => element.classList.remove('hidden'));
            }

            function hideElements(elements) {
                elements.forEach(element => element.classList.add('hidden'));
            }

            if (method === "from1") {
                showElements(mediumIndex2);
                angle1.classList.remove('hidden');
                hideElements(mediumIndex1);
            } else if (method === "from2") {
                showElements(mediumIndex1);
                angle1.classList.remove('hidden');
                hideElements(mediumIndex2);
            } else if (method === "from3") {
                showElements(mediumIndex1);
                showElements(mediumIndex2);
                angle2.classList.remove('hidden');
                angle1.classList.add('hidden');
            } else {
                showElements(mediumIndex1);
                showElements(mediumIndex2);
                angle1.classList.remove('hidden');
                angle2.classList.add('hidden');
            }
        @endif

        function medium_change_f(element) {
            let mediumValF = element.value;
            let n1 = document.getElementById('n1');

            switch (mediumValF) {
                case "vacuum":
                    n1.value = "1";
                    break;
                case "air":
                    n1.value = "1.000293";
                    break;
                case "water":
                    n1.value = "1.333";
                    break;
                case "ethanol":
                    n1.value = "1.36";
                    break;
                case "ice":
                    n1.value = "1.31";
                    break;
                case "acrylic":
                    n1.value = "1.49";
                    break;
                case "window":
                    n1.value = "1.52";
                    break;
                case "diamond":
                    n1.value = "2.419";
                    break;
                default:
                    n1.value = "";
            }
        }

        function medium_change_s(element) {
            let mediumValS = element.value;
            let n2 = document.getElementById('n2');

            switch (mediumValS) {
                case "vacuum":
                    n2.value = "1";
                    break;
                case "air":
                    n2.value = "1.000293";
                    break;
                case "water":
                    n2.value = "1.333";
                    break;
                case "ethanol":
                    n2.value = "1.36";
                    break;
                case "ice":
                    n2.value = "1.31";
                    break;
                case "acrylic":
                    n2.value = "1.49";
                    break;
                case "window":
                    n2.value = "1.52";
                    break;
                case "diamond":
                    n2.value = "2.419";
                    break;
                default:
                    n2.value = "";
            }
        }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>