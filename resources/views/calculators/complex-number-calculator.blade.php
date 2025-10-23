<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-12">
                <label for="exp" class="label">{{$lang['1']}}</label>
                <div class="w-full py-2">
                    <input type="text" name="exp" id="exp" class="input" value="{{ isset($request->exp)?$request->exp:'(2+5i)(5-3i)' }}" aria-label="input"/>
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
                            @php
                                $enter=$detail['enter'];
                                $expand=$detail['expand'];
                                $expand1=$detail['expand1'];
                                $a=$detail['a'];
                                $b=$detail['b'];
                                $b1=$detail['b1'];
                                $r=$detail['r'];
                                $theta=$detail['theta'];
                                $simp=$detail['simp'];
                                $opr=preg_match('/\-/',$b)?'+':'-';
                                $b=preg_replace('/\-/','',$b);
                            @endphp
                            <div class="w-full text-[16px]">
                                <p class="mt-3 font-s-18">
                                    \( {{$detail['expand1']}} \)
                                </p>
                                <p class="mt-3 font-s-18"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3 font-s-18">
                                    \( \normalsize{ {{$r}}(cos({{$theta}}) + isin({{$theta}}))} \)
                                </p>
                                <p class="mt-3 font-s-18"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-3 font-s-18">
                                    \( \Large{\frac{1}{ {{$expand1}} }} = \Large{\frac{ {{$a}} }{ {{$simp}} }} {{$opr}} \Large{\frac{ {{$b}} }{ {{$simp}} }} \normalsize{\approx {{$a/$simp}} {{$opr}} \frac{ {{$b}} } { {{$simp}}i} } \)
                                </p>
                                <p class="mt-3 font-s-18"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-3 font-s-18">
                                    \( {{$a}}{{preg_match('/\-/',$b1)?preg_replace('/\-/','+',$b1):$b1*(-1)}}i \)
                                </p>
                                <p class="mt-3 font-s-18"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-3 font-s-18">
                                    \( {{$r}} \approx {{sqrt($simp)}} \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['8']}}</strong></p>
                                <p class="mt-3">{{$lang['9']}}</p>
                                <p class="mt-3">\( {{$enter}} = {{$expand}} \)</p>
                                <p class="mt-3">({{$lang['10']}} <a href="https://calculator-online.net/foil-calculator/" class="text-blue" target="_blank">{{$lang[11]}}</a> {{$lang['12']}})</p>
                                <p class="mt-3">{{$lang['13']}} \( i^2 = -1, \) {{$lang['14']}}:</p>
                                <p class="mt-3">\( {{$enter}} = {{preg_replace('/i\^\{2}/','(-1)',$expand)}} \)</p>
                                <p class="mt-3">\( {{$enter}} = {{$expand1}} \)</p>
                                <p class="mt-3">{{$lang['4']}}</p>
                                <p class="mt-3">{{$lang['15']}} \( a + bi \), {{$lang['16']}} \( r(cos(θ)+isin(θ)), \) {{$lang['17']}} \( r=\sqrt{a^2+b^2} \) {{$lang['18']}} \( θ=atan\large{(\frac{b}{a})} \)</p>
                                <p class="mt-3">{{$lang['19']}}:</p>
                                <p class="mt-3">\( a = {{$a}} \) {{$lang['18']}} \( b = {{$b1}} \)</p>
                                <p class="mt-3">\( r=\sqrt{({{$a}})^2+({{$b1}})^2} = {{$r}} \)</p>
                                <p class="mt-3">\( θ=atan\large{(\frac{{{$b1}}}{{{$a}}})} = \normalsize{{{$theta}}} \)</p>
                                <p class="mt-3">{{$lang['20']}},</p>
                                <p class="mt-3">\( {{$expand1}} = {{$r}}(cos({{$theta}}) + isin({{$theta}})) \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">{{$lang['27']}} {{$lang['21']}} {{$lang['23']}} \( {{$expand1}} \) {{$lang['22']}} \( \Large{\frac{1}{{{$expand1}}}} \)</p>
                                <p class="mt-3">{{$lang['6']}} {{$lang['23']}} (a+bi) {{$lang['22']}} (a-bi), {{$lang['30']}} \( \Large{\frac{1}{a+bi}} \) {{$lang['24']}}:</p>
                                <p class="mt-3">\( \Large{\frac{1}{a+bi}} = \Large{\frac{1}{(a+bi)(a-bi)}} \normalsize{(a-bi)} \)</p>
                                <p class="mt-3">\( \Large{\frac{1}{a+bi}} = \Large{\frac{a-bi}{a^2+b^2}} \)</p>
                                <p class="mt-3">{{$lang['25']}}:</p>
                                <p class="mt-3">\( \Large{\frac{1}{a+bi}} = \Large{\frac{a}{a^2+b^2}-\frac{bi}{a^2+b^2}} \)</p>
                                <p class="mt-3">{{$lang['26']}}, \( a = {{$a}} \) {{$lang['18']}} \( b = {{$b1}} \)</p>
                                <p class="mt-3">{{$lang['20']}},</p>
                                {{-- <p class="mt-3">\( \Large{\frac{1}{{{$expand1}}}} = \Large{\frac{{{$a}}}{{{$simp}}}} \small{{{$opr}}} \Large{\frac{{{$b}}}{{{$simp}}}} \normalsize{\approx {{$a/$simp}} {{$opr}} {{$b/$simp}}i} \)</p> --}}
                                <p class="mt-3">{{$lang['6']}}</p>
                                <p class="mt-3">{{$lang['27']}} {{$lang['6']}} {{$lang['23']}} \( (a+bi) \) {{$lang['22']}} \( (a-bi) \), {{$lang['29']}},</p>
                                <p class="mt-3">{{$lang['27']}} {{$lang['6']}} {{$lang['23']}} \( ({{$expand1}}) \) {{$lang['22']}} \( ({{$a}}{{preg_match('/\-/',$b1)?preg_replace('/\-/','+',$b1):$b1*(-1)}}i) \)</p>
                                <p class="mt-3">{{$lang['7']}}</p>
                                <p class="mt-3">{{$lang['27']}} {{$lang['28']}} {{$lang['23']}} \( (a+bi) \) {{$lang['22']}} \( (\sqrt{a^2+b^2}) \), {{$lang['29']}},</p>
                                <p class="mt-3">{{$lang['27']}} {{$lang['28']}} {{$lang['23']}} \( {{$expand1}} \) {{$lang['22']}} \( {{$r}} \approx {{sqrt($simp)}} \)</p>
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
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('units_active');
                    });
                    this.classList.add('units_active');
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
                                element.classList.remove('col-6');
                                element.classList.add('col-4');
                            });
                        });
                        document.querySelectorAll('#EnterEq').forEach(function(element) {
                            element.value = 'e^y+cos(xz)';
                        });
                        document.querySelectorAll('#functionText').forEach(function(element) {
                            element.textContent = '{{$lang['1']}} f(x, y, z):';
                        });
                    } else {
                        ['#zValue', '#u3Value'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('d-none');
                            });
                        });
                        ['#u1Value', '#u2Value', '#xValue', '#yValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('col-6');
                                element.classList.remove('col-4');
                            });
                        });
                        document.querySelectorAll('#EnterEq').forEach(function(element) {
                            element.value = 'e^(x)+y^2';
                        });
                        document.querySelectorAll('#functionText').forEach(function(element) {
                            element.textContent = '{{$lang['1']}} f(x, y)';
                        });
                    }
                });
            });
        </script>
    @endpush
</form>