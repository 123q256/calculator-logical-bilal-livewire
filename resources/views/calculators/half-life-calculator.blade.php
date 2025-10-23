<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="w-full mx-auto my-2 ">
                <input type="hidden" name="calculator_name" id="calculator_name" value="calculator1">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  lg:gap-4 md:gap-4 gap-1 flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 ">
                    <div class="space-y-2  px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer tagsUnit rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white " id="calculator1" data-value="calculator1">
                            {{ isset($lang['calculator']) ? $lang['calculator'] : 'Calculator' }}
                        </div>
                    </div>
                    <div class="space-y-2  px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white " id="calculator2"  data-value="calculator2">
                            {{ isset($lang['converter']) ? $lang['converter'] : 'Converter' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4 calculators calculator1">
             
                <div class="col-lg-6 px-2">
                    <label for="find" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="find" id="find" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2]." (Nₜ)",$lang[3]." (N₀)",$lang[4]." (t)",$lang[5]." (t₁/₂)"];
                                $val = ["nt","n0","t","t1_2"];
                                optionsList($val,$name,isset(request()->find)?request()->find:'t1_2');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 px-2 nt">
                    <label for="nt" class="font-s-14 text-blue">{!! $lang['2'] !!} (N<sub class="text-blue">t</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="nt" id="nt" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->nt)?request()->nt:'10' }}" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 n0">
                    <label for="n0" class="font-s-14 text-blue">{!! $lang['3'] !!} (N<sub class="text-blue">0</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" name="n0" id="n0" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->n0)?request()->n0:'100' }}" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 t">
                    <label for="t" class="font-s-14 text-blue">{!! $lang['4'] !!} (t):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" name="t" id="t" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->t)?request()->t:'50' }}" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 t1_2 d-none">
                    <label for="t1_2" class="font-s-14 text-blue">{!! $lang['5'] !!} (t<sub class="text-blue">1/2</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" name="t1_2" id="t1_2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->t1_2)?request()->t1_2:'15' }}" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 hidden  gap-4 calculators calculator2 ">
                <h2 class="text-blue font-s-18 px-2 mb-3">{{ $lang['6'] }}</h2>
                <div class="row">
                    <div class="col-lg-6 px-2 imperial_input">
                        <label for="find_by" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="find_by" id="find_by" class="input">
                                @php
                                    $name = [$lang[5]." (t₁/₂)",$lang[8]." (τ)",$lang[9]." (λ)"];
                                    $val = ["t_1_2","T","lamda"];
                                    optionsList($val,$name,isset(request()->find_by)?request()->find_by:'t_1_2');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 px-2 t_1_2">
                        <label for="t_1_2" class="font-s-14 text-blue">{!! $lang['5'] !!} (t<sub class="text-blue">1/2</sub>):</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="t_1_2" id="t_1_2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->t_1_2)?request()->t_1_2:'15' }}" />
                        </div>
                    </div>
                    <div class="col-lg-6 px-2 T d-none">
                        <label for="T" class="font-s-14 text-blue">{!! $lang['8'] !!} (τ):</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="T" id="T" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->T)?request()->T:'50' }}" />
                        </div>
                    </div>
                    <div class="col-lg-6 px-2 lamda d-none">
                        <label for="lamda" class="font-s-14 text-blue">{!! $lang['9'] !!} (λ):</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="lamda" id="lamda" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->lamda)?request()->lamda:'10' }}" />
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
                    <div class="w-full radius-10 p-3 mt-3">
                        <div class="w-full mt-2">
                            @php
                                $nt = request()->nt;
                                $n0 = request()->n0;
                                $t = request()->t;
                                $t1_2 = request()->t1_2;
                            @endphp
                            @if(request()->calculator_name === "calculator1")
                                @php
                                    $ans=$detail['ans'];
                                    $s1=isset($detail['s1']) ? $detail['s1'] : '';
                                    $s2=isset($detail['s2']) ? $detail['s2'] : '';
                                    $s3= isset($detail['s3']) ? $detail['s3'] : '';
                                    $s4=isset($detail['s4']) ? $detail['s4'] : '';
                
                                    if(request()->find==='nt'){
                                        $head='Quantity Remains \( (N_t) \)';
                                    }elseif(request()->find==='n0'){
                                        $head='Initial Quantity \( (N_0) \)';
                                    }elseif(request()->find==='t'){
                                        $head="Time \( (t) \)";
                                    }elseif(request()->find==='t1_2'){
                                        $head='Half Life \( (t_{\frac{1}{2}}) \)';
                                    }
                                @endphp
                                <p><strong>{{ $head }}</strong></p>
                                <p><strong class="text-[#119154] text-[32px]">{{ round($ans,4) }}</strong></p>
                                <div class="col-12 mt-2">
                                    <p class="font-s-20"><strong>{{ $lang[10] }}:</strong></p>
                                    <p class="my-2"><strong>{{ $lang[11] }}:</strong></p>
                                    @if(request()->find==='nt')
                                        <p class="my-2">\( N_t = N_0 \left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2}} } } \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_0 = {{ $n0 }}, t = {{ $t }}, t_{\frac{1}{2}} = {{ $t1_2 }}, N_t = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( N_t = N_0 \left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2}} } } \)</p>
                                        <p class="my-2">\( N_t = {{ $n0 }} * \left(\dfrac{1}{2} \right)^\dfrac{ {{ $t }} }{ { {{ $t1_2 }} } } \)</p>
                                        <p class="my-2">\( N_t = {{ $n0 }} * (0.5)^{{{ $s1 }}} \)</p>
                                        <p class="my-2">\( N_t = {{ $n0 }} * {{ $s2 }} \)</p>
                                        <p class="my-2">\( N_t = {{ $ans }} \)</p>
                                    @elseif(request()->find==='n0')
                                        <p class="my-2">\( N_0 = \dfrac{N_t} {\left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2}} } } } \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_t = {{ $nt }}, t = {{ $t }}, t_{\frac{1}{2}} = {{ $t1_2 }}, N_0 = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( N_0 = \dfrac{N_t} {\left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2} } } } } \)</p>
                                        <p class="my-2">\( N_0 = \dfrac{ {{ $nt }} }{\left(\dfrac{1}{2} \right)^\dfrac{ {{ $t }} }{ { {{ $t1_2 }} } } } \)</p>
                                        <p class="my-2">\( N_0 = \dfrac{ {{ $nt }} }{(0.5)^{ {{ $s1 }} }} \)</p>
                                        <p class="my-2">\( N_0 = \dfrac{ {{ $nt }} }{ {{ $s2 }} } \)</p>
                                        <p class="my-2">\( N_0 = {{ $ans }} \)</p>
                                    @elseif(request()->find==='t')
                                        <p class="my-2">\( t = \dfrac{t_{\frac{1}{2}} ln \left(\dfrac{N_t}{N_0} \right)}{-ln(2)} \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_t = {{ $nt }}, N_0 = {{ $n0 }}, t_{\frac{1}{2}} = {{ $t1_2 }}, t = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( t = \dfrac{t_{\frac{1}{2}} ln \left(\dfrac{N_t}{N_0} \right)}{-ln(2)} \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $t1_2 }} * ln \left(\dfrac{ {{ $nt }} }{ {{ $n0 }} } \right)}{-ln(2)} \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $t1_2 }} * ln ( {{ $s1 }} )}{-ln(2)} \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $t1_2 }} * ( {{ $s2 }} )}{ {{ $s4 }} } \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $s3 }} }{ {{ $s4 }} } \)</p>
                                        <p class="my-2">\( t = {{ $ans }} \)</p>
                                    @elseif(request()->find==='t1_2')
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{t * (-ln(2))}{ln \left(\dfrac{N_t}{N_0} \right)} \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_t = {{ $nt }}, N_0 = {{ $n0 }}, t = {{ $t }}, t_{\frac{1}{2}} = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{t * (-ln(2))}{ln \left(\dfrac{N_t}{N_0} \right)} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $t }} * (-ln(2))}{ln \left(\dfrac{ {{ $nt }} }{ {{ $n0 }} } \right)} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $t }} * (-ln(2))}{ln ({{ $s1 }}) } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $t }} * {{ $s3 }} }{ {{ $s2 }} } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $s4 }} }{ {{ $s2 }} } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $ans }} \)</p>
                                    @endif
                                </div>
                            @else
                                @php
                                    $t_1_2=$detail['t_1_2'];
                                    $T=$detail['T'];
                                    $lamda=$detail['lamda'];
                                @endphp
                                <p><strong>{{ $lang[5] }} \( (t_{\frac{1}{2}}) \)</strong></p>
                                <p class="font-s-28"><strong class="{{ (request()->find_by==='t_1_2')?'':'text-[#119154] text-[30px]' }}">{{ round($t_1_2,4) }}</strong></p>
                                <p><strong>{{ $lang[8] }} (τ)</strong></p>
                                <p class="font-s-28"><strong class="{{ (request()->find_by==='T')?'':'text-[#119154] text-[30px]' }}">{{ round($T,4) }}</strong></p>
                                <p><strong>{{ $lang[9] }} (λ)</strong></p>
                                <p class="font-s-28"><strong class="{{ (request()->find_by==='lamda')?'':'text-[#119154] text-[30px]' }}">{{ round($lamda,4) }}</strong></p>
                                <div class="col-12 mt-3">
                                    <p class="font-s-20"><strong>{{ $lang[10] }}:</strong></p>
                                    @if(request()->find_by==='t_1_2')
                                        <p class="my-2"><strong>{{ $lang[8] }} (τ):</strong></p>
                                        <p class="my-2">\( τ = \dfrac{t_{\frac{1}{2}} }{ln(2)} \)</p>
                                        <p class="my-2">\( τ = \dfrac{ {{ $t_1_2 }} }{ {{(log(2))}} } \)</p>
                                        <p class="my-2">\( τ = {{ $T }} \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[9] }} (λ):</strong></p>
                                        <p class="my-2">\( λ = \dfrac{ln(2)}{t_{\frac{1}{2}}} \)</p>
                                        <p class="my-2">\( λ = \dfrac{ {{(log(2))}} }{ {{ $t_1_2 }} } \)</p>
                                        <p class="my-2">\( λ = {{ $lamda }} \)</p>
                                    @elseif(request()->find_by==='T')
                                        <p class="my-2"><strong>{{ $lang[5] }} \( (t_{\frac{1}{2}}) \):</strong></p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = τ * ln(2) \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $T }} * {{(log(2))}} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $t_1_2 }} \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[9] }} (λ):</strong></p>
                                        <p class="my-2">\( λ = \dfrac{ln(2)}{t_{\frac{1}{2}}} \)</p>
                                        <p class="my-2">\( λ = \dfrac{ {{(log(2))}} }{ {{ $t_1_2 }} } \)</p>
                                        <p class="my-2">\( λ = {{ $lamda }} \)</p>
                                    @elseif(request()->find_by==='lamda')
                                        <p class="my-2"><strong>{{ $lang[5] }} \( (t_{\frac{1}{2}}) \):</strong></p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ln(2)}{λ} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{(log(2))}} }{ {{ $lamda }} } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $t_1_2 }} \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[8] }} (τ):</strong></p>
                                        <p class="my-2">\( τ = \dfrac{t_{\frac{1}{2}}}{ln(2)} \)</p>
                                        <p class="my-2">\( τ = \dfrac{ {{ $t_1_2 }} }{ {{(log(2))}} } \)</p>
                                        <p class="my-2">\( τ = {{ $T }} \)</p>
                                    @endif
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
            function find() {
                var findValue = document.getElementById('find').value;
                document.querySelectorAll('.n0, .t, .t1_2, .nt').forEach(function(element) {
                    element.style.display = 'none';
                });

                if (findValue === "nt") {
                    document.querySelectorAll('.n0, .t, .t1_2').forEach(function(element) {
                        element.style.display = 'block';
                    });
                } else if (findValue === "n0") {
                    document.querySelectorAll('.nt, .t, .t1_2').forEach(function(element) {
                        element.style.display = 'block';
                    });
                } else if (findValue === "t") {
                    document.querySelectorAll('.nt, .n0, .t1_2').forEach(function(element) {
                        element.style.display = 'block';
                    });
                } else if (findValue === "t1_2") {
                    document.querySelectorAll('.nt, .n0, .t').forEach(function(element) {
                        element.style.display = 'block';
                    });
                }
            }

            document.getElementById('find').addEventListener('change', find);

            function find_by() {
                var findByValue = document.getElementById('find_by').value;
                document.querySelectorAll('.t_1_2, .T, .lamda').forEach(function(element) {
                    element.style.display = 'none';
                });

                if (findByValue === "t_1_2") {
                    document.querySelector('.t_1_2').style.display = 'block';
                } else if (findByValue === "T") {
                    document.querySelector('.T').style.display = 'block';
                } else if (findByValue === "lamda") {
                    document.querySelector('.lamda').style.display = 'block';
                }
            }

            document.getElementById('find_by').addEventListener('change', find_by);

            // Initial call to set the correct visibility based on the initial values
            find();
            find_by();

            let val = "{{ !empty(request()->calculator_name) ? request()->calculator_name : 'calculator1' }}"
            document.querySelectorAll('.calculators').forEach(function(calculator) {
                calculator.style.display = 'none';
            });
            document.querySelector('.' + val).style.display = 'block';
            document.querySelectorAll('.pacetab').forEach(function(tab) {
                tab.classList.remove('tagsUnit');
            });
            document.querySelector('#' + val).classList.add('tagsUnit');
            document.getElementById("calculator_name").value = val;
            document.querySelectorAll('.pacetab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    let val = this.getAttribute('data-value');
                    document.querySelectorAll('.calculators').forEach(function(calculator) {
                        calculator.style.display = 'none';
                    });
                    document.querySelector('.' + val).style.display = 'block';
                    document.querySelectorAll('.pacetab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    document.getElementById("calculator_name").value = val;
                });
            });

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

                window.addEventListener('load', function(){
                    loadMathJax();
                });
            @endif
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>