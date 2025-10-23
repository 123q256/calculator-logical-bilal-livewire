<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            @php $request = request(); @endphp

            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[100%] w-full">
                <input type="hidden" name="type"
                    value="{{ isset($request->type) && $request->type === 'three' ? 'three' : 'two' }}" id="type">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'three' ? '' : 'tagsUnit' }}"
                            id="imperial" data-value="two">
                            for (x , y)
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'three' ? 'tagsUnit' : '' }}"
                            id="metric" data-value="three">
                            for (x , y , z)
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 mt-4">

                <div class="col-span-12">
                    <label for="EnterEq" class="font-s-14 text-blue" id="functionText">
                        @if (isset($request->type) && $request->type === 'three')
                            {{ $lang['1'] }} f(x, y, z):
                        @else
                            {{ $lang['1'] }} f(x, y):
                        @endif
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input"
                            value="{{ isset($request->EnterEq) ? $request->EnterEq : 'e^(x)+y^2' }}"
                            aria-label="input" />
                    </div>
                </div>
                <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4' : 'col-span-6' }}"
                    id="u1Value">
                    <label for="u1" class="font-s-14 text-blue">U1:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="u1" id="u1" class="input"
                            value="{{ isset($request->u1) ? $request->u1 : '1' }}" aria-label="input" />
                    </div>
                </div>
                <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4' : 'col-span-6' }}"
                    id="u2Value">
                    <label for="u2" class="font-s-14 text-blue">U2:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="u2" id="u2" class="input"
                            value="{{ isset($request->u2) ? $request->u2 : '3' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-4 {{ isset($request->type) && $request->type === 'three' ? '' : 'd-none' }}"
                    id="u3Value">
                    <label for="u3" class="font-s-14 text-blue">U3:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="u3" id="u3" class="input"
                            value="{{ isset($request->u3) ? $request->u3 : '2' }}" aria-label="input" />
                    </div>
                </div>
                <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4' : 'col-span-6' }}"
                    id="xValue">
                    <label for="x" class="font-s-14 text-blue">x {{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x" id="x" class="input"
                            value="{{ isset($request->x) ? $request->x : '0' }}" aria-label="input" />
                    </div>
                </div>
                <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4' : 'col-span-6' }}"
                    id="yValue">
                    <label for="y" class="font-s-14 text-blue">y {{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="y" id="y" class="input"
                            value="{{ isset($request->y) ? $request->y : '3' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-4 {{ isset($request->type) && $request->type === 'three' ? '' : 'd-none' }}"
                    id="zValue">
                    <label for="z" class="font-s-14 text-blue">z {{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="z" id="z" class="input"
                            value="{{ isset($request->z) ? $request->z : '2' }}" aria-label="input" />
                    </div>
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
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
                            @php
                                $EnterEq = $request->EnterEq;
                                $u1 = $request->u1;
                                $u2 = $request->u2;
                                $u3 = $request->u3;
                                $x = $request->x;
                                $y = $request->y;
                                $z = $request->z;
                                $type = $request->type;
                                $EnterEq = str_replace('+', 'plus', $EnterEq);
                            @endphp
                            <div class="w-full text-[16px]">
                                @if ($type === 'two')
                                    <p class="mt-3 text-[18px]">
                                        \( D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }})\) ≈ \(
                                        {{ $detail['ans'] }}\)
                                    </p>
                                    <p class="mt-3"><strong>{{ $lang['4'] }}</strong></p>
                                    <p class="mt-3">{{ $lang['5'] }} \({{ $detail['enter'] }}\) {{ $lang['6'] }}
                                        \((x,y)=({{ $x . ',' . $y }})\) {{ $lang['7'] }} \(\vec u
                                        =({{ $u1 . ',' . $u2 }})\)
                                    </p>
                                    <p class="mt-3">{{ $lang['8'] }}.</p>
                                    <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial
                                        f}{\partial
                                        y}\right)\)</p>
                                    <p class="mt-3">\(\frac{\partial f}{\partial x} = {{ $detail['difs1'] }}\)</p>
                                    <p class="mt-3">\(\frac{\partial f}{\partial y} = {{ $detail['difs2'] }}\)</p>
                                    <p class="mt-3">Put the points</p>
                                    <p class="mt-3">\(∇f({{ $x . ',' . $y }}) =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] }})\)
                                    </p>
                                    <p class="mt-3">\(∇({{ $detail['enter'] }})|_{(x,y)=({{ $x . ',' . $y }})} =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] }})\)</p>
                                    <p class="mt-3">{{ $lang['9'] }}:</p>
                                    <p class="mt-3">\( |\vec u| = \sqrt{({{ $u1 . ')^2 + (' . $u2 . ')^2' }})} =
                                        {{ round($detail['mag'], 5) }}\)</p>
                                    <p class="mt-3">{{ $lang['10'] }}:</p>
                                    <p class="mt-3">\( |\vec u| \text{ becomes }= \left( \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} },\frac{ {{ $u2 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">{{ $lang['11'] }}:</p>
                                    <p class="mt-3">\(D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }}) =
                                        \left({{ $detail['x1'] . ',' . $detail['y1'] }}\right) . \left( \frac{
                                        {{ $u1 }}
                                        }{ {{ round($detail['mag'], 5) }} },\frac{ {{ $u2 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">\(D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }}) = \left(
                                        ({{ $detail['x1'] }} \times \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} }) + ( {{ $detail['y1'] }} \times\frac{
                                        {{ $u2 }} }{ {{ round($detail['mag'], 5) }} }) \right)\)</p>
                                    <p class="mt-3">{{ $lang['3'] }}:</p>
                                    <p class="mt-3">\(D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }}) =
                                        {{ $detail['ans'] }}\)</p>
                                @else
                                    <p class="mt-3 text-[18px]">
                                        \( D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y . ',' . $z }}) \) ≈ \(
                                        {{ $detail['ans'] }} \)
                                    </p>
                                    <p class="mt-3"><strong>{{ $lang['4'] }}</strong></p>
                                    <p class="mt-3">{{ $lang['5'] }} \({{ $detail['enter'] }}\) {{ $lang['6'] }}
                                        \((x,y,z)=({{ $x . ',' . $y . ',' . $z }})\) {{ $lang['7'] }} \(\vec u
                                        =({{ $u1 . ',' . $u2 . ',' . $u3 }})\)</p>
                                    <p class="mt-3">{{ $lang['8'] }}.</p>
                                    <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial
                                        f}{\partial
                                        y},\frac{\partial f}{\partial z}\right)\)</p>
                                    <p class="mt-3">\( \frac{\partial f}{\partial x} = {{ $detail['difs1'] }}\)</p>
                                    <p class="mt-3">\( \frac{\partial f}{\partial y} = {{ $detail['difs2'] }}\)</p>
                                    <p class="mt-3">\( \frac{\partial f}{\partial z} = {{ $detail['difs3'] }}\)</p>
                                    <p class="mt-3">Put the points</p>
                                    <p class="mt-3">\( ∇f({{ $x . ',' . $y . ',' . $z }}) =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1'] }})\)</p>
                                    <p class="mt-3">\(
                                        ∇({{ $detail['enter'] }})|_{(x,y,z)=({{ $x . ',' . $y . ',' . $z }})} =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1'] }})\)</p>
                                    <p class="mt-3">{{ $lang['9'] }}:</p>
                                    <p class="mt-3">\( |\vec u| =
                                        \sqrt{({{ $u1 . ')^2 + (' . $u2 . ')^2 + (' . $u3 . ')^2' }})} =
                                        {{ round($detail['mag'], 5) }}\)</p>
                                    <p class="mt-3">{{ $lang['10'] }}:</p>
                                    <p class="mt-3">\( |\vec u| \text{ becomes }= \left( \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} },\frac{ {{ $u2 }} }{
                                        {{ round($detail['mag'], 5) }} },\frac{ {{ $u3 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">{{ $lang['11'] }}:</p>
                                    <p class="mt-3">\( D({{ $detail['enter'] }})_{\vec
                                        u}({{ $x . ',' . $y . ',' . $z }}) =
                                        \left({{ $detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1'] }}\right) .
                                        \left( \frac{
                                        {{ $u1 }} }{ {{ round($detail['mag'], 5) }} },\frac{
                                        {{ $u2 }}
                                        }{ {{ round($detail['mag'], 5) }} },\frac{ {{ $u3 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">\( D({{ $detail['enter'] }})_{\vec
                                        u}({{ $x . ',' . $y . ',' . $z }}) =
                                        \left( ({{ $detail['x1'] }} \times \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} }) + ( {{ $detail['y1'] }} \times\frac{
                                        {{ $u2 }} }{ {{ round($detail['mag'], 5) }} }) + (
                                        {{ $detail['z1'] }}
                                        \times\frac{ {{ $u3 }} }{ {{ round($detail['mag'], 5) }} }) \right)\)
                                    </p>
                                    <p class="mt-3">{{ $lang['3'] }}:</p>
                                    <p class="mt-3">\( D({{ $detail['enter'] }})_{\vec
                                        u}({{ $x . ',' . $y . ',' . $z }}) =
                                        {{ $detail['ans'] }}\)</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'three') {
                        ['#zValue', '#u3Value'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('d-none');
                            });
                        });
                        ['#u1Value', '#u2Value', '#xValue', '#yValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('col-span-6');
                                element.classList.add('col-span-4');
                            });
                        });
                        document.querySelectorAll('#EnterEq').forEach(function(element) {
                            element.value = 'e^y+cos(xz)';
                        });
                        document.querySelectorAll('#functionText').forEach(function(element) {
                            element.textContent = '{{ $lang['1'] }} f(x, y, z):';
                        });
                    } else {
                        ['#zValue', '#u3Value'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('d-none');
                            });
                        });
                        ['#u1Value', '#u2Value', '#xValue', '#yValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('col-span-6');
                                element.classList.remove('col-span-4');
                            });
                        });
                        document.querySelectorAll('#EnterEq').forEach(function(element) {
                            element.value = 'e^(x)+y^2';
                        });
                        document.querySelectorAll('#functionText').forEach(function(element) {
                            element.textContent = '{{ $lang['1'] }} f(x, y)';
                        });
                    }
                });
            });
        </script>
    @endpush
</form>
