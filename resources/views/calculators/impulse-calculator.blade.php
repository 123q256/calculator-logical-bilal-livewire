<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="calculation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="calculation" id="calculation" onchange="calculation_method(this)">
                        <option value="1" {{ isset($_POST['calculation']) && $_POST['calculation'] == '1' ? 'selected' : '' }}> {{ $lang[2] }} J | {{ $lang[3] }} F, t  </option>
                        <option value="2"  {{ isset($_POST['calculation']) && $_POST['calculation'] == '2' ? 'selected' : '' }}> {{ $lang[2] }} F | {{ $lang[3] }} J, t  </option>
                        <option value="3"  {{ isset($_POST['calculation']) && $_POST['calculation'] == '3' ? 'selected' : '' }}> {{ $lang[2] }} t | {{ $lang[3] }} J, F  </option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <p class="col s12 font_size20 center" id="math_s">
                    $$ J \ = \ F \ t $$
                </p>
                <p class="col s12 font_size20 center hidden" id="math_d">
                    $$ F \ = \ \frac{J}{t} $$
                </p>
                <p class="col s12 font_size20 center hidden" id="math_t">
                    $$ t \ = \ \frac{J}{F} $$
                </p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 impulse hidden">
                <label for="impulse" class="font-s-14 text-blue">{{ $lang['4'] }} (J)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="impulse" id="impulse" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['impulse']) ? $_POST['impulse'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="j_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('j_units_dropdown')">{{ isset($_POST['j_units'])?$_POST['j_units']:'dyn·s' }} ▾</label>
                    <input type="text" name="j_units" value="{{ isset($_POST['j_units'])?$_POST['j_units']:'dyn·s' }}" id="j_units" class="hidden">
                    <div id="j_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="j_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'dyn·s')">dyn·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'dyn·min')">dyn·min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'dyn·h')">dyn·h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'kg·m/s')">kg·m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'N·s')">N·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'N·min')">N·min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'N·h')">N·h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'mN·s')">mN·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'mN·min')">mN·min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'kN·s')">kN·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('j_units', 'kN·min')">kN·min</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 force">
                <label for="force" class="font-s-14 text-blue">{{ $lang['5'] }} (f)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="force" id="force" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force']) ? $_POST['force'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="f_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_units_dropdown')">{{ isset($_POST['f_units'])?$_POST['f_units']:'dyn' }} ▾</label>
                    <input type="text" name="f_units" value="{{ isset($_POST['f_units'])?$_POST['f_units']:'dyn' }}" id="f_units" class="hidden">
                    <div id="f_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'dyn')">dyn</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'kgf')">kgf</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'kip')">kip</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'lbf')">lbf</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'ozf')">ozf</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'pdl')">pdl</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 time">
                <label for="time" class="font-s-14 text-blue">{{ $lang['6'] }} (t)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="t_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_units_dropdown')">{{ isset($_POST['t_units'])?$_POST['t_units']:'sec' }} ▾</label>
                    <input type="text" name="t_units" value="{{ isset($_POST['t_units'])?$_POST['t_units']:'sec' }}" id="t_units" class="hidden">
                    <div id="t_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'sec')">sec</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'min')">min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'hr')">hr</p>
                    </div>
                 </div>
            </div>
            
           
            <div class="col-span-12 impulse_units">
                <label for="impulse_ans_units" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="impulse_ans_units" id="impulse_ans_units">
                        <option value="dyn·s" {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'dyn·s' ? 'selected' : '' }} > dyn·s</option>
                        <option value="dyn·min"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'dyn·min' ? 'selected' : '' }} >dyn·min </option>
                        <option value="dyn·h"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'dyn·h' ? 'selected' : '' }} > dyn·h </option>
                        <option value="kg·m/s"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'kg·m/s' ? 'selected' : '' }} > kg·m/s </option>
                        <option value="N·s"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'N·s' ? 'selected' : '' }} > N·s </option>
                        <option value="N·min"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'N·min' ? 'selected' : '' }} > N·min </option>
                        <option value="N·h"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'N·h' ? 'selected' : '' }} > N·h </option>
                        <option value="mN·s"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'mN·s' ? 'selected' : '' }} > mN·s </option>
                        <option value="mN·min"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'mN·min' ? 'selected' : '' }} > mN·min </option>
                        <option value="kN·s"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'kN·s' ? 'selected' : '' }} > kN·s </option>
                        <option value="kN·min"  {{ isset($_POST['impulse_ans_units']) && $_POST['impulse_ans_units'] == 'kN·min' ? 'selected' : '' }} > kN·min  </option>
                    </select>
                </div>  
            </div>
            <div class="col-span-12 force_units hidden">
                <label for="force_ans_units" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="force_ans_units" id="force_ans_units">
                        <option value="dyn" {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'dyn' ? 'selected' : '' }} > dyn</option>
                        <option value="kgf"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'kgf' ? 'selected' : '' }} >kgf </option>
                        <option value="N"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'N' ? 'selected' : '' }} > N</option>
                        <option value="kN"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'kN' ? 'selected' : '' }} > kN </option>
                        <option value="kip"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'kip' ? 'selected' : '' }} > kip</option>
                        <option value="lbf"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'lbf' ? 'selected' : '' }} > lbf </option>
                        <option value="ozf"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'ozf' ? 'selected' : '' }} > ozf</option>
                        <option value="pdl"  {{ isset($_POST['force_ans_units']) && $_POST['force_ans_units'] == 'pdl' ? 'selected' : '' }} > pdl </option>
                    </select>
                </div>   
            </div>
            <div class="col-span-12 time_units hidden">
                <label for="time_ans_units" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="time_ans_units" id="time_ans_units">
                        <option value="sec" {{ isset($_POST['time_ans_units']) && $_POST['time_ans_units'] == 'sec' ? 'selected' : '' }} > sec</option>
                        <option value="min"  {{ isset($_POST['time_ans_units']) && $_POST['time_ans_units'] == 'min' ? 'selected' : '' }} >min </option>
                        <option value="hr"  {{ isset($_POST['time_ans_units']) && $_POST['time_ans_units'] == 'hr' ? 'selected' : '' }} > hr </option>
                    </select>
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
                        <div class="w-full text-center text-[18px]">
                            <p>{{ $lang[4] }}</p>
                            @if(isset($detail['calculation']) && $detail['calculation'] =="1")
                            <p><strong>{{ $lang[4]}}</strong></p>
                            @elseif(isset($detail['calculation']) && $detail['calculation'] =="2")
                            <p><strong>{{ $lang[5]}}</strong></p>
                            @else
                            <p><strong>{{ $lang[6]}}</strong></p>
                            @endif
                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ round($detail['answer'], 4) }} {{ $detail['unit_ans']}}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endisset
</form>
@push('calculatorJS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
</script>
<script>

    function calculation_method(element) {
        var method_val = element.value;
        if (method_val === "1") {
            document.getElementById("math_s").style.display = "block";
            document.querySelectorAll(".force, .time, .impulse_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_t, #math_d, .impulse, .time_units, .force_units").forEach(function (el) {
                el.style.display = "none";
            });
        } else if (method_val === "2") {
            document.getElementById("math_d").style.display = "block";
            document.querySelectorAll(".impulse, .time, .force_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_s, #math_t, .force, .time_units, .impulse_units").forEach(function (el) {
                el.style.display = "none";
            });
        } else {
            document.getElementById("math_t").style.display = "block";
            document.querySelectorAll(".impulse, .force, .time_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_d, #math_s, .time, .impulse_units, .force_units").forEach(function (el) {
                el.style.display = "none";
            });
        }
    }

    @if(isset($detail))
            var method_val = "{{$_POST['calculation']}}";
        if (method_val === "1") {
            document.getElementById("math_s").style.display = "block";
            document.querySelectorAll(".force, .time, .impulse_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_t, #math_d, .impulse, .time_units, .force_units").forEach(function (el) {
                el.style.display = "none";
            });
        } else if (method_val === "2") {
            document.getElementById("math_d").style.display = "block";
            document.querySelectorAll(".impulse, .time, .force_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_s, #math_t, .force, .time_units, .impulse_units").forEach(function (el) {
                el.style.display = "none";
            });
        } else {
            document.getElementById("math_t").style.display = "block";
            document.querySelectorAll(".impulse, .force, .time_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_d, #math_s, .time, .impulse_units, .force_units").forEach(function (el) {
                el.style.display = "none";
            });
        }

    @endif

    @if(isset($error))
        var method_val = "{{$_POST['calculation']}}";
        if (method_val === "1") {
            document.getElementById("math_s").style.display = "block";
            document.querySelectorAll(".force, .time, .impulse_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_t, #math_d, .impulse, .time_units, .force_units").forEach(function (el) {
                el.style.display = "none";
            });
        } else if (method_val === "2") {
            document.getElementById("math_d").style.display = "block";
            document.querySelectorAll(".impulse, .time, .force_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_s, #math_t, .force, .time_units, .impulse_units").forEach(function (el) {
                el.style.display = "none";
            });
        } else {
            document.getElementById("math_t").style.display = "block";
            document.querySelectorAll(".impulse, .force, .time_units").forEach(function (el) {
                el.style.display = "block";
            });
            document.querySelectorAll("#math_d, #math_s, .time, .impulse_units, .force_units").forEach(function (el) {
                el.style.display = "none";
            });
        }

    @endif

</script>
@endpush