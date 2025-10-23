<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-6">
                    <label for="dem" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="dem" id="dem" class="input">
                            <option value="2" {{ isset($_POST['dem']) && $_POST['dem'] == '2' ? 'selected' : '' }}>2-D
                            </option>
                            <option value="3" {{ isset($_POST['dem']) && $_POST['dem'] == '3' ? 'selected' : '' }} selected>
                                3-D</option>
                            <option value="4" {{ isset($_POST['dem']) && $_POST['dem'] == '4' ? 'selected' : '' }}>4-D
                            </option>
                            <option value="5" {{ isset($_POST['dem']) && $_POST['dem'] == '5' ? 'selected' : '' }}>5-D
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a_rep" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a_rep" id="a_rep" class="input">
                            <option value="coor" {{ isset($_POST['a_rep']) && $_POST['a_rep'] == 'coor' ? 'selected' : '' }}>
                                {{ $lang['3'] }}</option>
                            <option value="point" {{ isset($_POST['a_rep']) && $_POST['a_rep'] == 'point' ? 'selected' : '' }}>
                                {{ $lang['4'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 a_coor">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-6">
                            <label for="ax" class="font-s-14 text-blue">x</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="ax" id="ax" class="input"
                                    aria-label="input" placeholder="00" value="{{ isset($_POST['ax']) ? $_POST['ax'] : '3' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="ay" class="font-s-14 text-blue">y</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="ay" id="ay" class="input"
                                    aria-label="input" placeholder="00" value="{{ isset($_POST['ay']) ? $_POST['ay'] : '4' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 three">
                            <label for="az" class="font-s-14 text-blue">z</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="az" id="az" class="input"
                                    aria-label="input" placeholder="00" value="{{ isset($_POST['az']) ? $_POST['az'] : '4' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 hidden four">
                            <label for="w" class="font-s-14 text-blue">w</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="w" id="w" class="input"
                                    aria-label="input" placeholder="00" value="{{ isset($_POST['w']) ? $_POST['w'] : '4' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 hidden five">
                            <label for="t" class="font-s-14 text-blue">t</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="t" id="t" class="input"
                                    aria-label="input" placeholder="00" value="{{ isset($_POST['t']) ? $_POST['t'] : '2' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 hidden a_points">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <p class="col-span-12"><strong>{{ $lang['5'] }} (A):</strong></p>
                        <div class="col-span-6">
                            <label for="a1" class="font-s-14 text-blue">x</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="a1" id="a1" class="input"
                                    aria-label="input" placeholder="00" value="{{ isset($_POST['a1']) ? $_POST['a1'] : '2' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="a2" class="font-s-14 text-blue">y</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="a2" id="a2" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['a2']) ? $_POST['a2'] : '2' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 three">
                            <label for="a3" class="font-s-14 text-blue">z</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="a3" id="a3" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['a3']) ? $_POST['a3'] : '2' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 four">
                            <label for="a4" class="font-s-14 text-blue">w</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="a4" id="a4" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['a4']) ? $_POST['a4'] : '-4' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 five">
                            <label for="a5" class="font-s-14 text-blue">t</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="a5" id="a5" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['a5']) ? $_POST['a5'] : '1' }}" />
                            </div>
                        </div>
                        <p class="col-span-12"><strong>{{ $lang['5'] }} (B):</strong></p>
                        <div class="col-span-6">
                            <label for="b1" class="font-s-14 text-blue">x</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="b1" id="b1" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['b1']) ? $_POST['b1'] : '1' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="b2" class="font-s-14 text-blue">y</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="b2" id="b2" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['b2']) ? $_POST['b2'] : '1' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 three">
                            <label for="b3" class="font-s-14 text-blue">z</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="b3" id="b3" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['b3']) ? $_POST['b3'] : '1' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 four">
                            <label for="b4" class="font-s-14 text-blue">w</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="b4" id="b4" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['b4']) ? $_POST['b4'] : '3' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 five">
                            <label for="b5" class="font-s-14 text-blue">t</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="b5" id="b5" class="input"
                                    aria-label="input" placeholder="00"
                                    value="{{ isset($_POST['b5']) ? $_POST['b5'] : '2' }}" />
                            </div>
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
                    <div class="w-full text-[20px] overflow-auto">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-100 font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['mag'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-2">{{ $lang['8'] }}:</p>
                        <p class="mt-2"><strong>{{ $lang['9'] }}: \( |\vec v| = \sqrt{\sum\limits_{i=1}^{n} |x_i|^2}\) ,
                                {{ $lang['10'] }} \(x_i , i= 1....n\) {{ $lang['11'] }}.</strong></p>
                        @if (isset($_POST['coor']) && $_POST['coor'] == 'coor')
                            <p class="mt-2">{{ $lang['12'] }}:</p>
                            @if (isset($_POST['dem']) && $_POST['dem'] == '2')
                                <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                            @elseif (isset($_POST['dem']) && $_POST['dem'] == '3')
                                <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2 + a_z^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                    ({{ $az }})^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }} +
                                    {{ pow($az, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                            @elseif (isset($_POST['dem']) && $_POST['dem'] == '4')
                                <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2 + a_z^2 + a_w^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                    ({{ $az }})^2 + ({{ $w }})^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }} +
                                    {{ pow($az, 2) }} + {{ pow($w, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                            @elseif (isset($_POST['dem']) && $_POST['dem'] == '5')
                                <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2 + a_z^2 + a_w^2 + a_t^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                    ({{ $az }})^2 + ({{ $w }})^2 + ({{ $t }})^2}\]</p>
                                <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }} +
                                    {{ pow($az, 2) }} + {{ pow($w, 2) }} + {{ pow($t, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                            @endif
                        @else
                            <p class="mt-2">{{ $lang['13'] }}:</p>
                            @if (isset($_POST['dem']) && $_POST['dem'] == '2')
                                @php
                                    $ax = $_POST['b1'] - $_POST['a1'];
                                    $ay = $_POST['b2'] - $_POST['a2'];
                                @endphp
                                <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{ {{ $_POST['b1'] }} -
                                    ({{ $_POST['a1'] }}),{{ $_POST['b2'] }} - ({{ $_POST['a2'] }})\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{ {{ $ax }},{{ $ay }}\}\]</p>
                                <p class="mt-2">{{ $lang['12'] }}:</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                            @elseif (isset($_POST['dem']) && $_POST['dem'] == '3')
                                @php
                                    $ax = $_POST['b1'] - $_POST['a1'];
                                    $ay = $_POST['b2'] - $_POST['a2'];
                                    $az = $_POST['b3'] - $_POST['a3'];
                                @endphp
        
                                <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y,B_z - A_z\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{ {{ $_POST['b1'] }} -
                                    ({{ $_POST['a1'] }}),{{ $_POST['b2'] }} - ({{ $_POST['a2'] }}),{{ $_POST['b3'] }} -
                                    ({{ $_POST['a3'] }})\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{
                                    {{ $ax }},{{ $ay }},{{ $az }}\}\]</p>
                                <p class="mt-2">{{ $lang['12'] }}:</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2 + AB_z^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                    ({{ $az }})^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }} +
                                    {{ pow($az, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                            @elseif (isset($_POST['dem']) && $_POST['dem'] == '4')
                                @php
                                    $ax = $_POST['b1'] - $_POST['a1'];
                                    $ay = $_POST['b2'] - $_POST['a2'];
                                    $az = $_POST['b3'] - $_POST['a3'];
                                    $w = $_POST['b4'] - $_POST['a4'];
                                @endphp
        
                                <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y,B_z - A_z,B_w - A_w\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{ {{ $_POST['b1'] }} -
                                    ({{ $_POST['a1'] }}),{{ $_POST['b2'] }} - ({{ $_POST['a2'] }}),{{ $_POST['b3'] }} -
                                    ({{ $_POST['a3'] }}),{{ $_POST['b4'] }} - ({{ $_POST['a4'] }})\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{
                                    {{ $ax }},{{ $ay }},{{ $az }},{{ $w }}\}\]</p>
                                <p class="mt-2">{{ $lang['12'] }}:</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2 + AB_z^2 + AB_w^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                    ({{ $az }})^2 + ({{ $w }})^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }} +
                                    {{ pow($az, 2) }} + {{ pow($w, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                            @elseif (isset($_POST['dem']) && $_POST['dem'] == '5')
                                @php
                                    $ax = $_POST['b1'] - $_POST['a1'];
                                    $ay = $_POST['b2'] - $_POST['a2'];
                                    $az = $_POST['b3'] - $_POST['a3'];
                                    $w = $_POST['b4'] - $_POST['a4'];
                                    $t = $_POST['b5'] - $_POST['a5'];
                                @endphp
        
                                <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y,B_z - A_z,B_w - A_w,B_t - A_t\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{ {{ $_POST['b1'] }} -
                                    ({{ $_POST['a1'] }}),{{ $_POST['b2'] }} - ({{ $_POST['a2'] }}),{{ $_POST['b3'] }} -
                                    ({{ $_POST['a3'] }}),{{ $_POST['b4'] }} - ({{ $_POST['a4'] }}),{{ $_POST['b5'] }} -
                                    ({{ $_POST['a5'] }})\}\]</p>
                                <p class="mt-2">\[ \vec{AB} = \{
                                    {{ $ax }},{{ $ay }},{{ $az }},{{ $w }},{{ $t }}\}\]
                                </p>
                                <p class="mt-2">{{ $lang['12'] }}:</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2 + AB_z^2 + AB_w^2 + AB_t^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                    ({{ $az }})^2 + ({{ $w }})^2 + ({{ $t }})^2}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($ax, 2) }} + {{ pow($ay, 2) }} +
                                    {{ pow($az, 2) }} + {{ pow($w, 2) }} + {{ pow($t, 2) }}}\]</p>
                                <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                            @endif
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
        document.getElementById('dem').addEventListener('change', function() {
            var dem = this.value;
            var elementsThree = document.querySelectorAll('.three');
            var elementsFour = document.querySelectorAll('.four');
            var elementsFive = document.querySelectorAll('.five');

            if (dem === '2') {
                elementsThree.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '3') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '4') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '5') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        });

        @if (isset($detail))
            var dem = "{{ $_POST['dem'] }}";
            var elementsThree = document.querySelectorAll('.three');
            var elementsFour = document.querySelectorAll('.four');
            var elementsFive = document.querySelectorAll('.five');

            if (dem === '2') {
                elementsThree.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '3') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '4') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '5') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        @endif

        @if (isset($error))
            var dem = "{{ $_POST['dem'] }}";
            var elementsThree = document.querySelectorAll('.three');
            var elementsFour = document.querySelectorAll('.four');
            var elementsFive = document.querySelectorAll('.five');

            if (dem === '2') {
                elementsThree.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '3') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.add('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '4') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else if (dem === '5') {
                elementsThree.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFour.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                elementsFive.forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        @endif


        var a_rep = document.getElementById('a_rep').value;
        var a_coor = document.querySelectorAll('.a_coor');
        var a_points = document.querySelectorAll('.a_points');

        if (a_rep === 'coor') {
            a_coor.forEach(function(element) {
                element.classList.remove('hidden');
            });
            a_points.forEach(function(element) {
                element.classList.add('hidden');
            });
        } else {
            a_coor.forEach(function(element) {
                element.classList.add('hidden');
            });
            a_points.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }


        document.getElementById('a_rep').addEventListener('change', function() {
            var a_rep = this.value;
            var a_coorElements = document.querySelectorAll('.a_coor');
            var a_pointsElements = document.querySelectorAll('.a_points');

            if (a_rep === 'coor') {
                a_coorElements.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                a_pointsElements.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else {
                a_coorElements.forEach(function(element) {
                    element.classList.add('hidden');
                });
                a_pointsElements.forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        });


        @if (isset($detail))
            var a_rep = "{{ $_POST['a_rep'] }}";
            var a_coorElements = document.querySelectorAll('.a_coor');
            var a_pointsElements = document.querySelectorAll('.a_points');

            if (a_rep === 'coor') {
                a_coorElements.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                a_pointsElements.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else {
                a_coorElements.forEach(function(element) {
                    element.classList.add('hidden');
                });
                a_pointsElements.forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        @endif

        @if (isset($error))
            var a_rep = "{{ $_POST['a_rep'] }}";
            var a_coorElements = document.querySelectorAll('.a_coor');
            var a_pointsElements = document.querySelectorAll('.a_points');

            if (a_rep === 'coor') {
                a_coorElements.forEach(function(element) {
                    element.classList.remove('hidden');
                });
                a_pointsElements.forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else {
                a_coorElements.forEach(function(element) {
                    element.classList.add('hidden');
                });
                a_pointsElements.forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>