<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
        <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-span-12 ">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="operations" id="operations">
                        <option value="3"
                            {{ isset($_POST['operations']) && $_POST['operations'] == '3' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="4"
                            {{ isset($_POST['operations']) && $_POST['operations'] == '4' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                        <option value="5"
                            {{ isset($_POST['operations']) && $_POST['operations'] == '5' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 text-center mt-0 mt-lg-2">
                <p id="math_s" class="">
                    {{ $lang[5] }} =
                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                        <span class="num">{{ $lang[6] }}</span>
                        <span class="visually-hidden"> / </span>
                        <span class="den">{{ $lang[7] }}</span>
                    </span>
                </p>
                <p id="math_d" class="hidden">
                    {{ $lang[6] }} =
                    <span aria-label=" with sum over count">
                        <span class="num">{{ $lang[5] }} x {{ $lang[7] }}</span>
                    </span>
                </p>
                <p id="math_t" class="hidden">
                    {{ $lang[7] }} =
                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                        <span class="num">{{ $lang[6] }}</span>
                        <span class="visually-hidden"> / </span>
                        <span class="den">{{ $lang[5] }}</span>
                    </span>
                </p>
            </div>
            <div class="col-span-12  hidden" id="f_div">
                <label for="first" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="first" id="first" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'inch per second' }} ▾</label>
                   <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'inch per second' }}" id="f_unit" class="hidden">
                   <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'inch per second')">in/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'inch per minute')">in/min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'foot per second')">ft/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'foot per minute')">ft/min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'foot per hour')">ft/hr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'yard per second')">yd/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'yard per minute')">yd/min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'yard per hour')">yd/hr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'centimeter per second')">cm/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'centimeter per minute')">cm/min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'meter per second')">m/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'meter per minute')">m/min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'meter per hour')">m/hr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mile per second')">mi/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mile per minute')">mi/min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mile per hour')">mi/h (mph)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kilometer per second')">km/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kilometer per hour')">km/h (kph)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'knot (nautical mi/h)')">knots</p>
                   </div>
                </div>
              </div>

            <div class="col-span-12  " id="s_div">
                <label for="second" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="second" id="second" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('s_unit_dropdown')">{{ isset($_POST['s_unit'])?$_POST['s_unit']:'inch' }} ▾</label>
                   <input type="text" name="s_unit" value="{{ isset($_POST['s_unit'])?$_POST['s_unit']:'inch' }}" id="s_unit" class="hidden">
                   <div id="s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="s_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'inch')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'foot')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'yard')">yd</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'mile')">mi</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'centimeter')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'meter')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'kilometer')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'nautical mile')">nmi</p>
                   </div>
                </div>
              </div>
            <div class="col-span-12 " id="t_div">
                <label for="third" class="font-s-14 text-blue" id="change">{{ $lang['7'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="third" id="third" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'year' }} ▾</label>
                   <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'year' }}" id="t_unit" class="hidden">
                   <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'year')">yr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'day')">d</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hour')">hr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'minute')">min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'second')">s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hhmmss')">hh:mm:ss</p>
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
                    @if ($detail['select'] == 3)
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[5] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'], 6) . ' ' . $lang[22] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[5] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'], 6) . ' m/s' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[10] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 39.37, 4) . ' ' . ' in/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[11] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 3.281, 4) . ' ' . ' ft/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[12] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 100, 4) . ' ' . ' cm/s' }}</td>
                                </tr>
                            </table>
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[13] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] / 1609, 4) . ' ' . ' mi/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[14] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] / 1000, 4) . ' ' . ' km/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[15] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 1.094, 4) . ' ' . ' yd/s' }}</td>
                                </tr>
                            </table>
                        </div>
                    @elseif($detail['select'] == 4)
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'], 6) . ' ' . $lang[23] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'], 6) . ' m' }} </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[10] }}</strong></td>
                                    <td class="py-2 border-b"> {{ number_format($detail['answer'] * 39.37, 4) . ' ' . ' in/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[11] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 3.281, 4) . ' ' . ' ft/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[12] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 100, 4) . ' ' . ' cm/s' }}</td>
                                </tr>
                            </table>
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[13] }}</strong></td>
                                    <td class="py-2 border-b"> {{ number_format($detail['answer'] / 1609, 4) . ' ' . ' mi/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[14] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] / 1000, 4) . ' ' . ' km/s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[15] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] * 1.094, 4) . ' ' . ' yd/s' }}</td>
                                </tr>
                            </table>
                        </div>
                    @elseif($detail['select'] == 5)
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[7] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer'] . ' ' . $lang[24] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[7] }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['answer'] . ' s' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[7] }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['time_show'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[7] }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['hours'] }} {{ $lang[25] }} {{ $detail['min'] }}
                                        {{ $lang[26] }} {{ $detail['sec'] }} {{ $lang[24] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[27] }}</strong></td>
                                    <td class="py-2 border-b"> {{ number_format($detail['answer'] / 31540000, 4) . ' ' . ' yr' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[28] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] / 2628000, 4) . ' ' . ' mon' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[29] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] / 86400, 4) . ' ' . ' d' }}</td>
                                </tr>
                            </table>
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[25] }}</strong></td>
                                    <td class="py-2 border-b"> {{ number_format($detail['answer'] / 3600, 4) . ' ' . ' h' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[26] }}</strong></td>
                                    <td class="py-2 border-b">{{ number_format($detail['answer'] / 60, 4) . ' ' . ' m' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>hh:mm:ss </strong></td>
                                    <td class="py-2 border-b">{{ $detail['time_show'] . ' ' . '' }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var unitOptions = document.querySelectorAll('.unit-option');
        var thirdInput = document.getElementById('third');
        var changeLabel = document.getElementById('change');

        unitOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                var cal = this.getAttribute('value');
                if (cal == 'day' || cal == 'hour' || cal == 'minute' || cal == 'second') {
                    thirdInput.setAttribute('type', 'number');
                    changeLabel.textContent = '{{ $lang[7] }}';
                    thirdInput.setAttribute('placeholder', '{{ $lang[7] }}');
                } else if (cal == 'hhmmss') {
                    thirdInput.setAttribute('type', 'text');
                    changeLabel.textContent = '{{ $lang[7] }} (hh:mm:ss)';
                    thirdInput.setAttribute('placeholder', 'hhmmss');
                }
            });
        });
    });


    @if (isset($detail))
        document.addEventListener('DOMContentLoaded', function() {
            var unitOptions = document.querySelectorAll('.unit-option');
            var thirdInput = document.getElementById('third');
            var changeLabel = document.getElementById('change');

            unitOptions.forEach(function(option) {
                var cal = "{{ $_POST['t_unit'] }}";
                if (cal == 'day' || cal == 'hour' || cal == 'minute' || cal == 'second') {
                    thirdInput.setAttribute('type', 'number');
                    changeLabel.textContent = '{{ $lang[7] }}';
                    thirdInput.setAttribute('placeholder', '{{ $lang[7] }}');
                } else if (cal == 'hhmmss') {
                    thirdInput.setAttribute('type', 'text');
                    changeLabel.textContent = '{{ $lang[7] }} (hh:mm:ss)';
                    thirdInput.setAttribute('placeholder', 'hhmmss');
                }
            });
        });
    @endif


    @if (isset($error))
        document.addEventListener('DOMContentLoaded', function() {
            var unitOptions = document.querySelectorAll('.unit-option');
            var thirdInput = document.getElementById('third');
            var changeLabel = document.getElementById('change');

            unitOptions.forEach(function(option) {
                var cal = "{{ $_POST['t_unit'] }}";
                if (cal == 'day' || cal == 'hour' || cal == 'minute' || cal == 'second') {
                    thirdInput.setAttribute('type', 'number');
                    changeLabel.textContent = '{{ $lang[7] }}';
                    thirdInput.setAttribute('placeholder', '{{ $lang[7] }}');
                } else if (cal == 'hhmmss') {
                    thirdInput.setAttribute('type', 'text');
                    changeLabel.textContent = '{{ $lang[7] }} (hh:mm:ss)';
                    thirdInput.setAttribute('placeholder', 'hhmmss');
                }
            });
        });
    @endif

    document.getElementById('operations').addEventListener('change', function() {
        var cal = this.value;

        var sDiv = document.getElementById('s_div');
        var tDiv = document.getElementById('t_div');
        var fDiv = document.getElementById('f_div');
        var mathS = document.getElementById('math_s');
        var mathT = document.getElementById('math_t');
        var mathD = document.getElementById('math_d');

        function showElements(elements) {
            elements.forEach(function(el) {
                el.classList.remove('hidden');
            });
        }

        function hideElements(elements) {
            elements.forEach(function(el) {
                el.classList.add('hidden');
            });
        }

        if (cal === '3') {
            showElements([sDiv, tDiv, mathS]);
            hideElements([fDiv, mathT, mathD]);
        } else if (cal === '4') {
            showElements([fDiv, tDiv, mathD]);
            hideElements([sDiv, mathT, mathS]);
        } else if (cal === '5') {
            showElements([sDiv, fDiv, mathT]);
            hideElements([tDiv, mathS, mathD]);
        }
    });


    @if (isset($detail))
        var cal = "{{ $_POST['operations'] }}";

        var sDiv = document.getElementById('s_div');
        var tDiv = document.getElementById('t_div');
        var fDiv = document.getElementById('f_div');
        var mathS = document.getElementById('math_s');
        var mathT = document.getElementById('math_t');
        var mathD = document.getElementById('math_d');

        function showElements(elements) {
            elements.forEach(function(el) {
                el.classList.remove('hidden');
            });
        }

        function hideElements(elements) {
            elements.forEach(function(el) {
                el.classList.add('hidden');
            });
        }

        if (cal === '3') {
            showElements([sDiv, tDiv, mathS]);
            hideElements([fDiv, mathT, mathD]);
        } else if (cal === '4') {
            showElements([fDiv, tDiv, mathD]);
            hideElements([sDiv, mathT, mathS]);
        } else if (cal === '5') {
            showElements([sDiv, fDiv, mathT]);
            hideElements([tDiv, mathS, mathD]);
        }
    @endif


    @if (isset($error))
        var cal = "{{ $_POST['operations'] }}";

        var sDiv = document.getElementById('s_div');
        var tDiv = document.getElementById('t_div');
        var fDiv = document.getElementById('f_div');
        var mathS = document.getElementById('math_s');
        var mathT = document.getElementById('math_t');
        var mathD = document.getElementById('math_d');

        function showElements(elements) {
            elements.forEach(function(el) {
                el.classList.remove('hidden');
            });
        }

        function hideElements(elements) {
            elements.forEach(function(el) {
                el.classList.add('hidden');
            });
        }

        if (cal === '3') {
            showElements([sDiv, tDiv, mathS]);
            hideElements([fDiv, mathT, mathD]);
        } else if (cal === '4') {
            showElements([fDiv, tDiv, mathD]);
            hideElements([sDiv, mathT, mathS]);
        } else if (cal === '5') {
            showElements([sDiv, fDiv, mathT]);
            hideElements([tDiv, mathS, mathD]);
        }
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>